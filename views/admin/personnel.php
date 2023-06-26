<?php
include_once 'app/config.php';
include_once 'app/Connection.php';
include_once 'app/RolEmployeeDB.php';
include_once 'app/EmployeeDB.php';
include_once 'app/ContactEmployeeDB.php';
include_once 'app/Session.php';
include_once 'app/Redirect.php';
include_once 'app/ImageValidator.php';

if (!Session::isset_sesion()) Redirect::redirect_to(ROUTE_ADMIN_LOGIN);

$message = "";

Connection::open_connection();
$roles = json_decode(RolEmployeeDB::get_roles(Connection::get_connection()))->data;
$employees = json_decode(EmployeeDB::get_employees(Connection::get_connection()))->data;

if (isset($_POST['eliminar'])) {
    $clv = (isset($_POST['clv']) && !empty($_POST['clv'])) ? $_POST['clv'] : '';

    if (!empty($clv)) {
        ContactEmployeeDB::delete_employee_contact(Connection::get_connection(), $clv);
        EmployeeDB::delete_employee(Connection::get_connection(), $clv);
        Redirect::redirect_to(ROUTE_ADMIN_PERSONNEL);
    }
    
}

if (isset($_POST['boton'])) {
    $name = (isset($_POST['name']) && !empty($_POST['name'])) ? $_POST['name'] : '';
    $rol = (isset($_POST['rol']) && !empty($_POST['rol'])) ? $_POST['rol'] : '';
    $description = (isset($_POST['description']) && !empty($_POST['description'])) ? $_POST['description'] : '';
    $email = (isset($_POST['email']) && !empty($_POST['email'])) ? 'mailto:'.$_POST['email'] : '';
    $linkedin = (isset($_POST['linkedin']) && !empty($_POST['linkedin'])) ? $_POST['linkedin'] : '';
    $instagram = (isset($_POST['instagram']) && !empty($_POST['instagram'])) ? $_POST['instagram'] : '';
    $image = (isset($_FILES['image']['tmp_name'])) ? $_FILES['image']['tmp_name'] : '';

    $validador_i = new ImageValidator($image, $_FILES['image']['name'], $_FILES['image']['size'], 'personnel');
    
    if (json_decode($validador_i->validateImage())->error) {
        $message = json_decode($validador_i->validateImage())->message;
    }else {
        $response = json_decode(EmployeeDB::insert_employee(Connection::get_connection(),  $rol, $name, $description, $validador_i->get_new_url()));
        $message = $response->message;
        
        if (!$response->error) {
            !empty($email) ? ContactEmployeeDB::insert_employee_contact(Connection::get_connection(), 3, $response->data, $email) : '';
            !empty($linkedin) ? ContactEmployeeDB::insert_employee_contact(Connection::get_connection(), 1, $response->data, $linkedin) : '';
            !empty($instagram) ? ContactEmployeeDB::insert_employee_contact(Connection::get_connection(), 2, $response->data, $instagram) : '';
            Redirect::redirect_to(ROUTE_ADMIN_PERSONNEL);
        }
    }
}

Connection::close_connection();

include_once 'components/html-opening.php';
include_once 'components/admin-navigation-bar.php';
?>

<main class="main-content-document">

    <div class="layout-1fr300px-300px margin-bg-top margin-xb-bottom">
        <div>
            <h3 class="text-title">Registro de personal</h3>    
            <div class="wrap-targets margin-bg-top">
                <?php
                Connection::open_connection();
                foreach ($employees as $key => $employee) {
                    $cnts = json_decode(ContactEmployeeDB::get_employees_contact(Connection::get_connection(), $employee->clv))->data;
                    ?>
                    <div class="presentation-card">
                        <img class="presentation-card_image image-rounded" src="<?php echo ROUTE_DYNAMIC_IMG . $employee->image_url; ?>" alt="">
                        <div class="absolute-center margin-sm-bottom">
                            <form action="<?php echo ROUTE_ADMIN_PERSONNEL; ?>" method="post">
                                <input type="hidden" name="clv" value="<?php echo $employee->clv; ?>">
                                <button name="eliminar" type="submit" class="delete-button no-bordered">eliminar persona</button>
                            </form>
                        </div>
                        <div class="presentation-card_body">
                            <p class="text-center">
                                <?php
                                foreach ($cnts as $cnt) {
                                    echo "<a class='link-app' target='_blank' href='$cnt->url_contact'>$cnt->name</a>";
                                }
                                ?>
                            </p>
                            <h2 class="text-center text-subtitle"><?php echo $employee->name; ?></h2>
                            <p class="text-center text-description"><?php echo $employee->rol; ?></p>
                        </div>
                    </div>
                    <?php
                }
                Connection::close_connection();
                ?>
            </div>
        </div>
        <form action="<?php echo ROUTE_ADMIN_PERSONNEL; ?>" enctype="multipart/form-data" method="post" autocomplete="off">
            
            <?php echo "<p class='text-content color-red text-center margin-sm-bottom'>$message</p>"; ?>

            <div class="margin-md-bottom">
                <label for="login-input-name" class="text-content">nombre: </label>
                <input type="text" name="name" id="login-input-name" class="input-form text-description" required>
            </div>
            
            <div class="margin-md-bottom">
                <label for="login-input-rol" class="text-content w-100">Pertence a: </label>
                <select name="rol" id="login-input-rol" class="input-form text-content" required>
                    <option value="">:: Selecciona</option>
                    <?php
                    foreach ($roles as $key => $rol) {
                        echo "<option value='$rol->clv'>$rol->name</option>";
                    }
                    ?>
                </select>
            </div>
            
            <div class="margin-md-bottom">
                <label for="login-input-description" class="text-content">Descripción: </label>
                <input type="text" name="description" id="login-input-description" class="input-form text-description" required>
            </div>

            <div class="margin-md-bottom">
                <label for="login-input-email" class="text-content">e-mail: </label>
                <input type="email" name="email" id="login-input-email" class="input-form text-description" required>
            </div>

            <div class="margin-md-bottom">
                <label for="login-input-linkedin" class="text-content">linkedIn LINK: </label>
                <input type="text" name="linkedin" id="login-input-linkedin" class="input-form text-description">
            </div>

            <div class="margin-md-bottom">
                <label for="login-input-instagram" class="text-content">Instagram LINK: </label>
                <input type="text" name="instagram" id="login-input-instagram" class="input-form text-description">
            </div>

            <input type="file" name="image" accept="image/*" class="input-form text-content" id="form-add-img" required>

            <button name="boton" type="submit" class="main-button no-bordered margin-md-top margin-sm-bottom">registrar</button>
        </form>
    </div>
</main>

<?php
include_once 'components/html-closing.php';
?>