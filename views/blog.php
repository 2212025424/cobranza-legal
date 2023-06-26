<?php
$document_title = "Artículos de Blog";
include_once 'app/config.php';
include_once 'app/Connection.php';
include_once 'app/ArticleDB.php';

Connection::open_connection();
$articles = json_decode(ArticleDB::get_articles(Connection::get_connection()))->data;
Connection::close_connection();

include_once 'components/html-opening.php';
include_once 'components/navigation-bar.php';
?>

<main>
    <div class="main-content-document">
        <section class="padding-xb-top padding-xb-bottom text-center">
            <h3 class="font-bold text-subtitle color-black margin-sm-bottom">Más de nuestro contenido</h3>
            <h2 class="no-font-bold text-main color-black-variation">ARTÍCULOS</h2>
        </section>
    </div>

    <section class="bg-color-white">
        <div class="main-content-document padding-xb-top padding-xb-bottom">
            <div class="wrap-targets">
                <?php
                foreach ($articles as $key => $article) {
                    ?>
                    <a href="<?php echo ROUTE_ARTICLE.'/'.md5($article->clv); ?>">
                        <div class="">
                            <img class="simple-target_image image-rounded" src="<?php echo ROUTE_DYNAMIC_IMG . $article->image_url; ?>" alt="">
                            <div class="simple-target_body">
                                <p class="text-description text-center font-bold margin-xm-bottom color-black-variation"><?php echo $article->category; ?></p>
                                <p class="text-content text-center color-black-variation"><?php echo $article->title; ?></p>
                            </div>
                        </div>
                    </a>
                    <?php
                }
                ?>
            </div>
        </div>
    </section>
</main>

<?php
include_once 'components/html-closing.php';
?>