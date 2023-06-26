<?php

/*------------------------------------------------------------------------------------------------------------------------
-------| RUTAS DE LA WEB sudo chown -R www-data:www-data /var/www/     sudo chmod -R g+rw /var/www/
------------------------------------------------------------------------------------------------------------------------*/

define("ROUTE_HOME", "https://www.cobranza-legal.us");
define("ROUTE_ADMIN_ADD_ARTICLES", ROUTE_HOME."/admin-add-articles");
define("ROUTE_ADMIN_ARTICLES", ROUTE_HOME."/admin-articles");
define("ROUTE_ADMIN_OFFICES", ROUTE_HOME."/admin-offices");
define("ROUTE_ADMIN_PERSONNEL", ROUTE_HOME."/admin-personnel");
define("ROUTE_ADMIN_LOGOUT", ROUTE_HOME."/admin-logout");
define("ROUTE_ADMIN_LOGIN", ROUTE_HOME."/admin-login");
define("ROUTE_ARTICLE", ROUTE_HOME."/articulo");
define("ROUTE_BLOG", ROUTE_HOME."/blog");
define("ROUTE_ABOUT_US", ROUTE_HOME."/conocenos");
define("ROUTE_BUSINESS", ROUTE_HOME."/negocios-limpios");
define("ROUTE_SERV_CIYSS", ROUTE_HOME."/contabilidad-impuestos-y-seguridad-social");
define("ROUTE_SERV_CR", ROUTE_HOME."/cumplimiento-regulatorio");
define("ROUTE_SERV_DA", ROUTE_HOME."/derecho-administrativo");
define("ROUTE_SERV_DCYC", ROUTE_HOME."/derecho-comercial-y-corporativo");
define("ROUTE_SERV_DL", ROUTE_HOME."/derecho-laboral");
define("ROUTE_SERV_PDA", ROUTE_HOME."/proteccion-de-activos");
define("ROUTE_SERV_PAEYC", ROUTE_HOME."/proteccion-a-empresas-y-consumidores");


/*------------------------------------------------------------------------------------------------------------------------
-------| RECURSOS DE LA WEB
------------------------------------------------------------------------------------------------------------------------*/

define("APP_NAME", "Cobranza Legal");
define("ROUTE_IMG", ROUTE_HOME."/assets/img/");
define("ROUTE_DYNAMIC_IMG", ROUTE_HOME."/assets/dynamic_images/");
define("ROUTE_ICO", ROUTE_HOME."/assets/icons/");
define("ROUTE_CSS", ROUTE_HOME."/styles/");
define("ROUTE_JS", ROUTE_HOME."/js/");
define("TARGET_DYNAMIC_IMAGES", "/var/www/cobranza-legal.us/assets/dynamic_images/");


/*------------------------------------------------------------------------------------------------------------------------
-------| ACCESOS DE LA BASE DE DATOS
------------------------------------------------------------------------------------------------------------------------*/

define("DB_HOST", "localhost");
define("DB_NAME", "cobranzalegaldb");
define("DB_USER", "usercobranzalegal");
define("DB_PASS", "\$us3rC0branzal3gal");


?>