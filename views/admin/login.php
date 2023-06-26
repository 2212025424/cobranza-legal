<?php
include_once 'app/config.php';
include_once 'app/Connection.php';
include_once 'app/UserDB.php';
include_once 'app/Session.php';
include_once 'app/Redirect.php';

if (Session::isset_sesion()) Redirect::redirect_to(ROUTE_ADMIN_ARTICLES);

$message = "";

if (isset($_POST['boton'])) {
    $name = (isset($_POST['name']) && !empty($_POST['name']) ? $_POST['name'] : '');
    $pass = (isset($_POST['password']) && !empty($_POST['password']) ? $_POST['password'] : '');

    Connection::open_connection();
    $data = json_decode(UserDB::get_user_by_name(Connection::get_connection(), $name));
    Connection::close_connection();
    
    $message = $data->message;
    
    if (!$data->error) {
        $user = $data->data;
        if (md5($pass) === $user->password) {
            Session::start_sesion($name);
            Redirect::redirect_to(ROUTE_ADMIN_ARTICLES);
        }else {
            $message = "Credenciales incorrectas";
        }
    }
}

include_once 'components/html-opening.php';
include_once 'components/navigation-bar.php';
?>

<main class="main-content-document absolute-center">
    <form action="<?php echo ROUTE_ADMIN_LOGIN; ?>" method="post" autocomplete="off" class="form-login margin-bg-top">
        <div class="margin-md-top margin-md-bottom">
            <label for="login-input-name text-content">Nombre de usuario: </label>
            <input type="text" name="name" id="login-input-name" class="input-form text-content" required>
        </div>
        <div class="margin-md-top margin-sm-bottom">
            <label for="login-input-password text-content">Contraseña de usuario: </label>
            <input type="password" name="password" id="login-input-password" class="input-form text-content" required>
        </div>
        <button name="boton" type="submit" class="main-button no-bordered w-100 margin-sm-top margin-sm-bottom">ingresar</button>
        <?php echo "<p class='text-content color-red text-center'>$message</p>"; ?>
    </form>
</main>

<?php
include_once 'components/html-closing.php';
?>