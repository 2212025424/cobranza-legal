<?php
$document_title = "Cumplimiento regulatorio";
include_once 'app/config.php';
include_once 'components/html-opening.php';
include_once 'components/navigation-bar.php';
?>

<main>
    <div class="main-content-document">
        <section class="padding-xb-top padding-xb-bottom text-center">
            <h1 class="color-black no-font-bold text-main ">CUMPLIMIENTO REGULATORIO</h1>
            <h3 class="color-black font-bold margin-md-top text-content">Lo que podemos hacer por tí</h3>
            <h2 class="color-black no-font-bold text-title">SOLUCIONAR PROBLEMAS</h2>
        </section>
    </div>

    <div class="bg-color-white">
        <section class="main-content-document section-image-text padding-xb-top padding-xb-bottom">
            <div class="section-text-image_image justify-flex-start">
                <img src="<?php echo ROUTE_IMG . 'bautista-abogados-cumplimiento-regulatorio-2.jpg'; ?>" alt="Negocios limpiios bautista">
            </div>    
            <div class="section-text-image_text">
                <p class="text-content color-black-variation text-justify margin-md-bottom font-bold">¿Te has preguntado que Leyes, Decretos, Normas Oficiales Mexicanas, Reglamentos o Circulares son obligatorios para tu empresa? ¿Cuáles son los permisos, licencias o avisos con los cuales debe contar tu empresa? ¿Cuáles decisiones del ejecutivo en los tres niveles de gobierno impactan a tu negocio?.</p>
                <p class="text-content color-black-variation text-justify">Nuestros abogados y consultores especializados en derecho regulatorio te dan respuesta a estas y más interrogantes, realizan auditorías legales a tu empresa, te representan ante distintas autoridades, cabildean las licencias necesarias para tu operación diaria, te asesoran en la interpretación de normas y te acompañan en el día a día en tu operación.</p>
            </div>
        </section>
    </div>
</main>

<?php
include_once 'components/html-closing.php';
?>