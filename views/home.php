<?php
include_once 'app/config.php';
include_once 'components/html-opening.php';
include_once 'components/navigation-bar.php';
?>

<main>
    <div class="padding-xb-top padding-xb-bottom">
        <section class="main-content-document section-text-image">
            <div class="section-text-image_text">
                <h3 class="font-bold text-subtitle color-black margin-md-bottom">Bufete Bautista y Asociados, S.C.</h3>
                <h2 class="no-font-bold text-main color-black-variation margin-sm-bottom">CONÓCENOS</h2>
                <p class="text-content color-black-variation margin-md-bottom text-justify font-bold">Somos una firma de abogados y fiscalistas especializada en asesorar a empresas de retail o comercio al por menor, que tiene la firme convicción de que en México se pueden hacer Negocios Limpios, libres de corrupción.</p>
                <p class="text-content color-black-variation margin-md-bottom text-justify">Queremos entender el negocio de nuestro cliente, sentirnos parte de su equipo, que ninguna consulta se deje de responder. Sabemos que el retailer es un negocio distinto, ¿Por qué no tener abogados y consultores distintos?; alguien que entienda la operación “365”, el cabildeo profesional y ético ante autoridades, las necesidades del piso de ventas, del e-commerce y el e-tail, el riesgo en los activos y la empatía con los recursos humanos.</p>
                <a class="main-button" href="<?php echo ROUTE_ABOUT_US; ?>">SOBRE EL BUFETE</a>
            </div>
            <div class="section-text-image_image">
                <img src="<?php echo ROUTE_IMG . 'logo.svg'; ?>" alt="imagen de contenido">
            </div>
        </section>
    </div>

    <div class="bg-color-white">
        <section class="main-content-document padding-xb-top padding-xb-bottom">
            <iframe width="100%" height="500" src="https://www.youtube.com/embed/lnLzg3DS5jQ" title="Somos abogados diferentes a los demás" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </section>
    </div>
    
    <section class="main-content-document padding-xb-top padding-xb-bottom">
        <div class="text-center margin-md-bottom">
            <h3 class="font-bold text-subtitle color-black margin-sm-bottom">Nuestra forma de trabajar</h3>
            <h2 class="no-font-bold text-main color-black-variation">NEGOCIOS LIMPIOS</h2>
        </div>
        <div class="section-image-text">
            <div class="section-text-image_image">
                <img src="<?php echo ROUTE_IMG . 'bautista-abogados-negocios-limpios.jpg'; ?>" alt="Negocios limpiios bautista">
            </div>    
            <div class="section-text-image_text">
                <p class="text-content color-black-variation margin-md-bottom text-justify font-bold">Un negocio limpio no es aquel que simplemente busca reducir sus emisiones, o hacer más ecológico el manejo de contaminantes, residuos y basura. Este es inmune a un virus que ha afectado a nuestra sociedad mucho antes que el COVID-19: LA CORRUPCIÓN.</p>
                <p class="text-content color-black-variation margin-md-bottom text-justify">En pocas palabras, un negocio limpio es aquel que opera no solo de forma regular y satisfactoria, sino también ha tomado la firme determinación de hacerlo de forma legal y sin participar en la corrupción, no solo porque la ley lo castiga, sino porque es parte de su cultura organizacional y social.</p>
                <a class="main-button" href="<?php echo ROUTE_BUSINESS; ?>">CONOCER MÁS</a>
            </div>
        </div>
    </section>
</main>

<?php
include_once 'components/html-closing.php';
?>