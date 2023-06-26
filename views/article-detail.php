<?php
include_once 'app/config.php';
include_once 'app/Connection.php';
include_once 'app/ArticleDB.php';
include_once 'app/Session.php';
include_once 'app/Redirect.php';

Connection::open_connection();
$response = json_decode(ArticleDB::get_article_by_clv(Connection::get_connection(), $current_article));
$articles = json_decode(ArticleDB::get_last_articles(Connection::get_connection(), 3))->data;
Connection::close_connection();

if ($response->error) Redirect::redirect_to(ROUTE_BLOG);
$article = $response->data;

$document_title = $article->title.' - '.$article->category;

include_once 'components/html-opening.php';
(!Session::isset_sesion()) ? include_once 'components/navigation-bar.php' : include_once 'components/admin-navigation-bar.php';
?>

<main class="main-content-document">
    <div class="layout-1fr300px-300px margin-bg-top margin-xb-bottom">
        <div class="article-content">
            <img class="article-content_image margin-sm-bottom" src="<?php echo ROUTE_DYNAMIC_IMG.$article->image_url; ?>" alt="<?php echo $article->title; ?>">
            <h1 class="text-main margin-sm-bottom font-bold"><?php echo $article->title; ?></h1>
            <h2 class="text-subtitle margin-md-bottom color-gray no-font-bold"><?php echo $article->summary; ?></h2>
            <p class="article-content_body text-content text-justify">
                <?php echo nl2br($article->body); ?>
            </p>
            <p class="text-description text-right margin-md-bottom margin-md-top"><span class="font-bold"><?php echo $article->category; ?></span> - <?php echo $article->date; ?></p>
        </div>
        <div>
            <h4 class="text-title">Artículos recientes</h4>
            <div class="wrap-targets margin-md-top">
                <?php
                foreach ($articles as $key => $carticle) {
                    ?>
                    <a href="<?php echo ROUTE_ARTICLE.'/'.md5($carticle->clv); ?>">
                        <div>
                            <img class="simple-target_image image-rounded" src="<?php echo ROUTE_DYNAMIC_IMG . $carticle->image_url; ?>" alt="<?php echo $carticle->title; ?>">
                            <div class="simple-target_body">
                                <p class="text-description text-center font-bold margin-xm-bottom color-black-variation"><?php echo $carticle->category; ?></p>
                                <p class="text-content text-center color-black-variation"><?php echo $carticle->title; ?></p>
                            </div>
                        </div>
                    </a>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</main>

<?php
include_once 'components/html-closing.php';
?>