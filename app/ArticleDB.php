<?php

class ArticleDB {
    
    private static $SQL_GET_ARTICLES = "SELECT a.clv AS clv, c.name AS category, a.title, a.summary, a.date, image_url FROM article a, category_article c WHERE a.clv_category = c.clv ORDER BY a.clv DESC";
    private static $SQL_GET_LAST_ARTICLES = "SELECT a.clv AS clv, c.name AS category, a.title, a.summary, a.date, image_url FROM article a, category_article c WHERE a.clv_category = c.clv ORDER BY a.clv DESC LIMIT :p_limit";
    private static $SQL_GET_ARTICLE_BY_CLV = "SELECT a.clv AS clv, c.name AS category, a.title, a.summary, a.body, a.date, image_url FROM article a, category_article c WHERE md5(a.clv) = :p_clv AND a.clv_category = c.clv ORDER BY a.clv DESC LIMIT 1";
    private static $SQL_INSERT_ARTICLE = "INSERT INTO `article`(`clv_category`, `title`, `summary`, `body`, `date`, `image_url`) VALUES(:p_clv_category, :p_title, :p_summary, :p_body, :p_date, :p_image_url)";
    
    public static function get_articles ($connection) {
        $response = array('error' => true, 'message' => 'No hay conexión a la base de datos','data' => null);
        
        if (isset($connection)) {
            try {

                $statement = $connection->prepare(SELF::$SQL_GET_ARTICLES);
                $statement->execute();
                $data = $statement->fetchAll();

                $response = array('error' => false, 'message' => null,'data' => $data);

            } catch (PDOException $ex) {
                $response = array('error' => true, 'message' => 'Ocurrió un error al intentar extraer los datos','data' => null);
            }
        }
        
        return json_encode($response);
    }
    
    public static function get_last_articles ($connection, $limit) {
        $response = array('error' => true, 'message' => 'No hay conexión a la base de datos','data' => null);
        
        if (isset($connection)) {
            try {

                $statement = $connection->prepare(SELF::$SQL_GET_LAST_ARTICLES);
                $statement->bindParam(':p_limit', $limit, PDO::PARAM_INT);
                $statement->execute();
                $data = $statement->fetchAll();

                $response = array('error' => false, 'message' => null,'data' => $data);

            } catch (PDOException $ex) {
                $response = array('error' => true, 'message' => 'Ocurrió un error al intentar extraer los datos','data' => null);
            }
        }
        
        return json_encode($response);
    }
    
    public static function get_article_by_clv ($connection, $clv) {
        $response = array('error' => true, 'message' => 'No hay conexión a la base de datos','data' => null);
        
        if (isset($connection)) {
            try {

                $statement = $connection->prepare(SELF::$SQL_GET_ARTICLE_BY_CLV);
                $statement->bindParam(':p_clv', $clv, PDO::PARAM_STR);
                $statement->execute();
                $data = $statement->fetch();

                if ($data) {
                    $response = array('error' => false, 'message' => null,'data' => $data);
                } else {
                    $response = array('error' => true, 'message' => 'No existe este documento','data' => null);
                }

            } catch (PDOException $ex) {
                $response = array('error' => true, 'message' => 'Ocurrió un error al intentar extraer los datos','data' => null);
            }
        }
        
        return json_encode($response);
    }
    
    public static function insert_article ($connection, $category, $title, $summary, $body, $date, $image) {
        $response = array('error' => true, 'message' => 'No hay conexión a la base de datos','data' => null);
        
        if (isset($connection)) {
            try {

                $statement = $connection->prepare(SELF::$SQL_INSERT_ARTICLE);
                $statement->bindParam(':p_clv_category', $category, PDO::PARAM_INT);
                $statement->bindParam(':p_title', $title, PDO::PARAM_STR);
                $statement->bindParam(':p_summary', $summary, PDO::PARAM_STR);
                $statement->bindParam(':p_body', $body, PDO::PARAM_STR);
                $statement->bindParam(':p_date', $date, PDO::PARAM_STR);
                $statement->bindParam(':p_image_url', $image, PDO::PARAM_STR);
                $statement->execute();
                $data = $statement->fetchAll();

                $response = array('error' => false, 'message' => 'Se ha insertado de forma correcta','data' => $data);

            } catch (PDOException $ex) {
                $response = array('error' => true, 'message' => 'Ocurrió un error al intentar insertar los datos' . $ex->getMessage(),'data' => null);
            }
        }
        
        return json_encode($response);
    }
}

?>