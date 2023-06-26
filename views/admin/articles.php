<?php
include_once 'app/config.php';
include_once 'app/Connection.php';
include_once 'app/CategoryArticleDB.php';
include_once 'app/ArticleDB.php';
include_once 'app/ImageValidator.php';
include_once 'app/Session.php';
include_once 'app/Redirect.php';

if (!Session::isset_sesion()) Redirect::redirect_to(ROUTE_ADMIN_LOGIN);

Connection::open_connection();
$categories = json_decode(CategoryArticleDB::get_categories(Connection::get_connection()))->data;
$articles = json_decode(ArticleDB::get_articles(Connection::get_connection()))->data;
Connection::close_connection();

include_once 'components/html-opening.php';
include_once 'components/admin-navigation-bar.php';
?>

<main class="main-content-document">
    <div class="margin-bg-top margin-xb-bottom">
        <div class="content-flex-space">
            <h3 class="text-title">Artículos de la web</h3>
            <a href="<?php echo ROUTE_ADMIN_ADD_ARTICLES; ?>" class="main-button">Añadir</a>
        </div>
        <div class="wrap-targets margin-bg-top">
            <?php
            foreach ($articles as $key => $article) {
                ?>
                <a href="<?php echo ROUTE_ARTICLE.'/'.md5($article->clv); ?>">
                    <div>
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
</main>

<?php
include_once 'components/html-closing.php';
?>