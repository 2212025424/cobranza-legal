<?php
include_once 'app/config.php';
include_once 'app/Connection.php';
include_once 'app/OfficeDB.php';
include_once 'app/Session.php';
include_once 'app/Redirect.php';
include_once 'app/ImageValidator.php';

if (!Session::isset_sesion()) Redirect::redirect_to(ROUTE_ADMIN_LOGIN);

$message = "";

Connection::open_connection();
$offices = json_decode(OfficeDB::get_offices(Connection::get_connection()))->data;

if (isset($_POST['eliminar'])) {
    $clv = (isset($_POST['clv']) && !empty($_POST['clv'])) ? $_POST['clv'] : '';

    if (!empty($clv)) {
        OfficeDB::delete_office(Connection::get_connection(), $clv);
        Redirect::redirect_to(ROUTE_ADMIN_OFFICES);
    }

}

if (isset($_POST['boton'])) {
    $city = (isset($_POST['city']) && !empty($_POST['city'])) ? $_POST['city'] : '';
    $address = (isset($_POST['address']) && !empty($_POST['address'])) ? $_POST['address'] : '';
    $phone = (isset($_POST['phone']) && !empty($_POST['phone'])) ? 'tel:'.$_POST['phone'] : '';
    $maps = (isset($_POST['maps']) && !empty($_POST['maps'])) ? $_POST['maps'] : '';
    $image = (isset($_FILES['image']['tmp_name'])) ? $_FILES['image']['tmp_name'] : '';

    $validador_i = new ImageValidator($image, $_FILES['image']['name'], $_FILES['image']['size'], 'offices');
    
    if (json_decode($validador_i->validateImage())->error) {
        $message = json_decode($validador_i->validateImage())->message;
    }else {
        $response = json_decode(OfficeDB::insert_office(Connection::get_connection(),  $city, $address, $phone, $maps, $validador_i->get_new_url()));
        $message = $response->message;
        
        if (!$response->error) {
            Redirect::redirect_to(ROUTE_ADMIN_OFFICES);
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
            <h3 class="text-title">Registro de oficinas</h3>    
            <div class="wrap-targets margin-bg-top">
                <?php
                foreach ($offices as $key => $office) {
                    ?>
                    <div class="presentation-card">
                        <a target="_blank" href="<?php echo $office->maps_url; ?>">
                        <img class="simple-target_image image-rounded" src="<?php echo ROUTE_DYNAMIC_IMG . $office->image_url; ?>" alt="<?php echo 'Mapa de oficina de ' . $office->city; ?>" title="ver mapa">
                        </a>
                        <div class="absolute-center margin-xm-bottom">
                            <form action="<?php echo ROUTE_ADMIN_OFFICES; ?>" method="post">
                                <input type="hidden" name="clv" value="<?php echo $office->clv; ?>">
                                <button name="eliminar" type="submit" class="delete-button no-bordered">eliminar oficina</button>
                            </form>
                        </div>
                        <div class="presentation-card_body text-center">
                            <h2 class="text-center text-subtitle"><?php echo $office->city; ?></h2>
                            <p class="text-center text-description margin-md-bottom"><?php echo $office->address; ?></p>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <form action="<?php echo ROUTE_ADMIN_OFFICES; ?>" enctype="multipart/form-data" method="post" autocomplete="off">
            
            <?php echo "<p class='text-content color-red text-center margin-sm-bottom'>$message</p>"; ?>

            <div class="margin-md-bottom">
                <label for="login-input-city" class="text-content">Ciudad: </label>
                <input type="text" name="city" id="login-input-city" class="input-form text-description" required>
            </div>
            
            <div class="margin-md-bottom">
                <label for="login-input-address" class="text-content">Dirección: </label>
                <input type="text" name="address" id="login-input-address" class="input-form text-description" required>
            </div>

            <div class="margin-md-bottom">
                <label for="login-input-phone" class="text-content">Teléfono: </label>
                <input type="tel" name="phone" id="login-input-phone" class="input-form text-description" required>
            </div>

            <div class="margin-md-bottom">
                <label for="login-input-maps" class="text-content">Maps LINK: </label>
                <input type="text" name="maps" id="login-input-maps" class="input-form text-description" required>
            </div>

            <input type="file" name="image" accept="image/*" class="input-form text-content" id="form-add-img" required>

            <button name="boton" type="submit" class="main-button no-bordered margin-md-top margin-sm-bottom">registrar</button>
        </form>
    </div>
</main>

<?php
include_once 'components/html-closing.php';
?>