<?php
include_once 'app/config.php';
include_once 'app/Session.php';
include_once 'app/Redirect.php';

Session::stop_sesion();
Redirect::redirect_to(ROUTE_ADMIN_LOGIN);
?>