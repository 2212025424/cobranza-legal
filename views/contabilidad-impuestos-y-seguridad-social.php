<?php
$document_title = "Contabilidad, impuestos y seguridad social";
include_once 'app/config.php';
include_once 'components/html-opening.php';
include_once 'components/navigation-bar.php';
?>

<main>
    <div class="main-content-document">
        <section class="padding-xb-top padding-xb-bottom text-center">
            <h1 class="color-black no-font-bold text-main ">CONTABILIDAD, IMPUESTOS Y SEGURIDAD SOCIAL</h1>
            <h3 class="color-black font-bold margin-md-top text-content">Lo que podemos hacer por tí</h3>
            <h2 class="color-black no-font-bold text-title">SOLUCIONAR PROBLEMAS</h2>
        </section>
    </div>

    <div class="bg-color-white">
        <section class="main-content-document section-text-image padding-xb-top padding-xb-bottom">
            <div class="section-text-image_text">
                <p class="text-title color-black-variation margin-md-bottom text-justify w-100 font-bold">Seguridad social</p>
                <p class="text-content color-black-variation text-justify">Nuestro grupo de especialistas le brinda información necesaria para el cumplimiento de las obligaciones corporativas de seguridad social y nómina, así como el cálculo de los impuestos y contribuciones que se deriven de las relaciones laborales.</p>
            </div>
            <div class="section-text-image_image">
                <img src="<?php echo ROUTE_IMG . 'bautista-abogados-seguridad-social-2.jpg'; ?>" alt="Negocios limpiios bautista">
            </div>
        </section>
    </div>
    
    <section class="main-content-document section-image-text padding-xb-top padding-xb-bottom">
        <div class="section-text-image_image justify-flex-start">
            <img src="<?php echo ROUTE_IMG . 'bautista-abogados-contabilidad-impuestos-2.jpg'; ?>" alt="Negocios limpiios bautista">
        </div>    
        <div class="section-text-image_text">
            <p class="text-title color-black-variation margin-md-bottom text-justify w-100 font-bold">Contabilidad e impuestos.</p>
            <p class="text-content color-black-variation text-justify">Procesamos detalladamente la información contable de la empresa y preparamos los estados financieros para que tenga información veraz, confiable y oportuna que le permita tomar decisiones acertadamente; uno de nuestros objetivos principales es la determinación y presentación de los impuestos en los tiempos que establece la Ley.</p>
        </div>
    </section>

    <div class="bg-color-white">
        <section class="main-content-document section-text-image padding-xb-top padding-xb-bottom">
            <div class="section-text-image_text">
                <p class="text-title color-black-variation margin-md-bottom text-justify w-100 font-bold">Asesoría fiscal</p>
                <p class="text-content color-black-variation text-justify">Derivado de la necesidad que tienen las empresas de contar con información oportuna; nuestros fiscalistas están encargados de construir estrategias fiscales apegadas siempre al marco normativo para que su empresa cumpla con todas las leyes fiscales que le son aplicables y pueda consolidar una estructura corporativa de acuerdo a sus necesidades de desarrollo.</p>
            </div>
            <div class="section-text-image_image justify-flex-start">
                <img src="<?php echo ROUTE_IMG . 'bautista-abogados-asesoria-fiscal-2.jpg'; ?>" alt="Negocios limpiios bautista">
            </div>
        </section>
    </div>

</main>

<?php
include_once 'components/html-closing.php';
?>