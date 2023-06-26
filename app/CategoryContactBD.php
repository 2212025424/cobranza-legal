<?php

class CategoryContactBD {
    private static $SQL_GET_CATEGORIES = "SELECT clv, icon_url, name FROM category_contact";
    
    public static function get_categories ($connection) {
        $response = array('error' => true, 'message' => 'No hay conexión a la base de datos','data' => null);
        
        if (isset($connection)) {
            try {

                $statement = $connection->prepare(SELF::$SQL_GET_CATEGORIES);
                $statement->execute();
                $data = $statement->fetchAll();

                $response = array('error' => false, 'message' => null,'data' => $data);

            } catch (PDOException $ex) {
                $response = array('error' => true, 'message' => 'Ocurrió un error al intentar extraer los datos','data' => null);
            }
        }
        
        return json_encode($response);
    }
}

?>