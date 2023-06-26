<?php
$current_path = $_SERVER['REQUEST_URI'];

$url_slices = explode('/', $current_path);
$url_slices = array_filter($url_slices);
$url_slices = array_slice($url_slices, 0);

switch ($url_slices[0]) {
    case 'articulo':
        $current_article = $url_slices[1];
        $current_directory = 'views/article-detail.php';
        break;
    case 'admin-personnel';
        $current_directory = 'views/admin/personnel.php';
        break;
    case 'admin-offices';
        $current_directory = 'views/admin/offices.php';
        break;
    case 'admin-add-articles';
        $current_directory = 'views/admin/articles-register.php';
        break;
    case 'admin-articles';
        $current_directory = 'views/admin/articles.php';
        break;
    case 'admin-logout';
        $current_directory = 'views/admin/logout.php';
        break;
    case 'admin-login';
        $current_directory = 'views/admin/login.php';
        break;
    case 'blog';
        $current_directory = 'views/blog.php';
        break;
    case 'conocenos';
        $current_directory = 'views/conocenos.php';
        break;
    case 'proteccion-a-empresas-y-consumidores';
        $current_directory = 'views/proteccion-a-empresas-y-consumidores.php';
        break;
    case 'proteccion-de-activos';
        $current_directory = 'views/proteccion-de-activos.php';
        break;
    case 'derecho-laboral';
        $current_directory = 'views/derecho-laboral.php';
        break;
    case 'derecho-comercial-y-corporativo';
        $current_directory = 'views/derecho-comercial-y-corporativo.php';
        break;
    case 'derecho-administrativo';
        $current_directory = 'views/derecho-administrativo.php';
        break;
    case 'cumplimiento-regulatorio';
        $current_directory = 'views/cumplimiento-regulatorio.php';
        break;
    case 'contabilidad-impuestos-y-seguridad-social';
        $current_directory = 'views/contabilidad-impuestos-y-seguridad-social.php';
        break;
    case 'negocios-limpios';
        $current_directory = 'views/negocios-limpios.php';
        break;
    default:
        $current_directory = 'views/home.php';
        break;
}

include_once($current_directory);
?>