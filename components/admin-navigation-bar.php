<nav class="document-navbar">
    <div class="main-content-navbar">
        <div class="document-navbar_left">
            <a href="<?php echo ROUTE_ADMIN_ARTICLES; ?>">
                <h1 class="text-title font-bold text-center document-navbar_name">BUFETE</h1>
                <h2 class="text-smalldata no-font-bold text-center document-navbar_subname">BAUTISTA Y ASOCIADOS</h2>
            </a>
        </div>
        <div class="document-navbar_right">
            <ul class="document-navbar_right document-navbar_desktop">
                <li><a href="<?php echo ROUTE_ADMIN_ARTICLES; ?>" class="document-navbar_element">Artículos</a></li>
                <li><a href="<?php echo ROUTE_ADMIN_OFFICES; ?>" class="document-navbar_element">Oficinas</a></li>
                <li><a href="<?php echo ROUTE_ADMIN_PERSONNEL; ?>" class="document-navbar_element">Personal</a></li>
                <li><a href="<?php echo ROUTE_ADMIN_LOGOUT; ?>" class="document-navbar_element">Salir</a></li>
            </ul>
            <div class="document-navbar_movile">
                <a class="document-navbar_movile-button"><img src="<?php echo ROUTE_ICO . 'icons8-menu.svg';?>" alt="Boton de menu lateral movil"></a>
                <ul class="document-navbar_movile-menu">
                    <li><a href="<?php echo ROUTE_ADMIN_ARTICLES; ?>" class="document-navbar_element w-100">Artículos</a></li>
                    <li><a href="<?php echo ROUTE_ADMIN_OFFICES; ?>" class="document-navbar_element w-100">Oficinas</a></li>
                    <li><a href="<?php echo ROUTE_ADMIN_PERSONNEL; ?>" class="document-navbar_element w-100">Personal</a></li>
                    <li><a href="<?php echo ROUTE_ADMIN_LOGOUT; ?>" class="document-navbar_element w-100">Salir</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>