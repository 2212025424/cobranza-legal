<?php
$document_title = "Conócenos";
include_once 'app/config.php';
include_once 'app/Connection.php';
include_once 'app/EmployeeDB.php';
include_once 'app/ContactEmployeeDB.php';
include_once 'app/OfficeDB.php';

Connection::open_connection();
$employees = json_decode(EmployeeDB::get_rand_employees(Connection::get_connection(), 4))->data;
$offices = json_decode(OfficeDB::get_offices(Connection::get_connection()))->data;
Connection::close_connection();

include_once 'components/html-opening.php';
include_once 'components/navigation-bar.php';
?>

<main>
    <div class="main-content-document">
        <section class="padding-xb-top padding-xb-bottom text-center">
            <h3 class="font-bold text-subtitle color-black margin-sm-bottom">Bufete Bautista y Asociados, S.C.</h3>
            <h2 class="no-font-bold text-main color-black-variation">CONÓCENOS</h2>
        </section>
    </div>

    <section class="bg-color-white">
        <div class="main-content-document padding-xb-top padding-xb-bottom">
            <div class="section-image-text">
                <div class="section-text-image_image justify-flex-start">
                    <img src="<?php echo ROUTE_IMG . 'bautista-abogados-conocenos-2.jpg'; ?>" alt="Negocios limpiios bautista">
                </div>    
                <div class="section-text-image_text">
                    <p class="text-content color-black-variation margin-md-bottom text-justify w-100 font-bold">¿Quiénes somos?.</p>
                    <p class="text-content color-black-variation margin-md-bottom text-justify">Somos una firma de abogados y fiscalistas especializada en asesorar a empresas de retail o comercio al por menor, con un gran compromiso en la generación de valor al interior del negocio; prestamos servicios con un alto estándar de ética, profesionalismo y buenas prácticas.</p>
                    <p class="text-content color-black-variation margin-md-bottom text-justify">Nuestra experiencia por más de diez años en cumplimiento normativo nos ha involucrado en el crecimiento y desarrollo de las compañías más importantes en México. Uno de los motivos por los que nos sentimos más orgullosos es que, más del 90% de los clientes corporativos que iniciaron con nosotros, continúan siendo nuestros clientes.</p>
                    <p class="text-content color-black-variation text-justify">Queremos entender el negocio de nuestro cliente, sentirnos parte de su equipo, que ninguna consulta se deje de responder. Sabemos que el retailer es un negocio distinto, ¿Por qué no tener abogados y consultores distintos?; alguien que entienda la operación “365”, el cabildeo profesional y ético ante autoridades, las necesidades del piso de ventas, del e-commerce y el e-tail, el riesgo en los activos y la empatía con los recursos humanos.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="main-content-document padding-xb-top padding-xb-bottom">
        <h3 class="text-title">Integrantes de equipo</h3>    
        <div class="wrap-targets margin-bg-top">
            <?php
            Connection::open_connection();
            foreach ($employees as $key => $employee) {
                $cnts = json_decode(ContactEmployeeDB::get_employees_contact(Connection::get_connection(), $employee->clv))->data;
                ?>
                <div class="presentation-card">
                    <img class="presentation-card_image image-rounded" src="<?php echo ROUTE_DYNAMIC_IMG . $employee->image_url; ?>" alt="">
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
    </section>

    <section class="bg-color-white">
        <div class="main-content-document section-text-image padding-xb-top padding-xb-bottom">
            <div class="section-text-image_text">
                <p class="text-title color-black-variation margin-md-bottom text-justify w-100 font-bold">Buenas prácticas</p>
                <p class="text-content color-black-variation margin-md-bottom text-justify">Cuidamos tu nombre, cuidamos el nuestro; nuestra asesoría y apoyo incluye actuación ante distintas autoridades, tanto administrativas como jurisdiccionales; cabildeo de licencias y permisos de operación federal y local, mapeo e interpretación de normas, procedimientos administrativos, procedimientos jurisdiccionales, reuniones de trabajo con representantes de gobierno en sus tres niveles con la estricta responsabilidad de hacer las cosas con honradez e integridad, “Nunca debemos caer en las manos de la descomposición social que engendra la corrupción”; por ello, representamos empresas mexicanas y extranjeras que tienen como rutina corporativa las buenas prácticas.</p>
                <p class="text-content color-black-variation text-justify">Estamos seguros que en México se pueden hacer #negocioslimpios, ya que a lo largo de los años hemos contribuido con nuestros clientes a lograrlo.</p>
            </div>
            <div class="section-text-image_image justify-flex-start">
                <img src="<?php echo ROUTE_IMG . 'bautista-abogados-buenas-practicas.jpg'; ?>" alt="Negocios limpiios bautista">
            </div>
        </div>
    </section>

    <section class="main-content-document padding-xb-top padding-xb-bottom">
        <h3 class="text-title">Nuestras oficinas</h3>
        <div class="wrap-targets margin-bg-top">
            <?php
            foreach ($offices as $key => $office) {
                ?>
                <div class="presentation-card">
                    <a target="_blank" href="<?php echo $office->maps_url; ?>">
                    <img class="simple-target_image image-rounded" src="<?php echo ROUTE_DYNAMIC_IMG . $office->image_url; ?>" alt="<?php echo 'Mapa de oficina de ' . $office->city; ?>" title="ver mapa">
                    </a>
                    <div class="presentation-card_body text-center">
                        <h2 class="text-center text-subtitle"><?php echo $office->city; ?></h2>
                        <p class="text-center text-description margin-md-bottom"><?php echo $office->address; ?></p>
                        <a class="main-button w-100" href="<?php echo $office->phone; ?>" target='_blank'>llamada directa</a>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </section>
</main>

<?php
include_once 'components/html-closing.php';
?>