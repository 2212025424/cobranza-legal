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
$articles = json_decode(ArticleDB::get_last_articles(Connection::get_connection(), 4))->data;

$message = "";

if (isset($_POST['boton'])) {
    $title = (isset($_POST['title']) && !empty($_POST['title'])) ? $_POST['title'] : '';
    $summary = (isset($_POST['summary']) && !empty($_POST['summary'])) ? $_POST['summary'] : '';
    $body = (isset($_POST['body']) && !empty($_POST['body'])) ? htmlentities(addslashes($_POST['body'])) : '';
    $category = (isset($_POST['category']) && !empty($_POST['category'])) ? $_POST['category'] : '';
    $image = (isset($_FILES['image']['tmp_name'])) ? $_FILES['image']['tmp_name'] : '';

    $validador_i = new ImageValidator($image, $_FILES['image']['name'], $_FILES['image']['size'], 'articles');
    
    if (json_decode($validador_i->validateImage())->error) {
        $message = json_decode($validador_i->validateImage())->message;
    }else {
        $response = json_decode(ArticleDB::insert_article(Connection::get_connection(),  $category, $title, $summary, $body, date("Y-n-j"), $validador_i->get_new_url()));    
        Redirect::redirect_to(ROUTE_ADMIN_ARTICLES);
    }
}

Connection::close_connection();

include_once 'components/html-opening.php';
include_once 'components/admin-navigation-bar.php';
?>

<main class="main-content-document">
    <div class="margin-bg-top margin-xb-bottom">
        <div class="content-flex-space margin-bg-bottom">
            <h3 class="text-title">Agregar artículos</h3>
            <a href="<?php echo ROUTE_ADMIN_ARTICLES; ?>" class="main-button">Ver artículos</a>
        </div>

        <?php echo "<p class='text-content color-red text-center margin-sm-bottom'>$message</p>"; ?>
        
        <form action="<?php echo ROUTE_ADMIN_ADD_ARTICLES; ?>" enctype="multipart/form-data" method="post" autocomplete="off" class="layout-2cols-min300px">
            <div>
                <div class="margin-md-bottom">
                    <label for="login-input-title" class="text-content">Título: </label>
                    <input type="text" name="title" id="login-input-title" class="input-form text-description" required>
                </div>

                <div class="margin-md-bottom">
                    <label for="login-input-summary" class="text-content">Resumen: </label>
                    <textarea name="summary" id="login-input-summary" class="input-form text-description textarea-sm" required></textarea>
                </div>

                <div class="margin-md-bottom">
                    <label for="login-input-category" class="text-content w-100">Categoría: </label>
                    <select name="category" id="login-input-category" class="input-form text-content" required>
                        <option value="">:: Selecciona</option>
                        <?php
                        foreach ($categories as $key => $cat) {
                            echo "<option value='$cat->clv'>$cat->name</option>";
                        }
                        ?>
                    </select>
                </div>

                <input type="file" name="image" accept="image/*" class="input-form text-content" id="form-add-img" required>
            </div>

            <div>
                <div class="margin-md-bottom">
                    <label for="login-input-body" class="text-content">Cuerpo: </label>
                    <textarea name="body" id="login-input-body" class="input-form text-description textarea-md" required></textarea>
                </div>

                <button name="boton" type="submit" class="main-button no-bordered margin-md-top margin-sm-bottom">publicar artículo</button>
            </div>
        </form>

        <h3 class="text-title margin-bg-top">Últimos artículos</h3>

        <div class="wrap-targets margin-bg-top">
            <?php
            foreach ($articles as $key => $article) {
                ?>
                <a href="<?php echo ROUTE_ARTICLE.'/'.md5($article->clv); ?>">
                        <div>
                            <img class="simple-target_image image-rounded" src="<?php echo ROUTE_DYNAMIC_IMG . $article->image_url; ?>" alt="<?php echo $carticle->title; ?>">
                            <div class="simple-target_body">
                                <p class="text-description text-center font-bold margin-xm-bottom color-black-variation"><?php echo $carticle->category; ?></p>
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