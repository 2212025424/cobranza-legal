<?php

class OfficeDB {

    private static $SQL_GET_OFFICES = "SELECT clv, city_name as city, address, phone, maps_url, image_url FROM office ORDER BY clv DESC";
    private static $SQL_GET_RANDOM_OFFICES = "SELECT clv, city_name as city, address, phone, maps_url, image_url FROM office ORDER BY RAND() LIMIT :p_limit";
    private static $SQL_INSERT_OFFICE = "INSERT INTO office (city_name, address, phone, maps_url, image_url) VALUES (:p_city_name, :p_address, :p_phone, :p_maps_url, :p_image_url)";
    private static $SQL_DELETE_OFFICE = "DELETE FROM office WHERE clv = :p_clv";
    
    public static function get_offices ($connection) {
        $response = array('error' => true, 'message' => 'No hay conexión a la base de datos','data' => null);
        
        if (isset($connection)) {
            try {

                $statement = $connection->prepare(SELF::$SQL_GET_OFFICES);
                $statement->execute();
                $data = $statement->fetchAll();

                $response = array('error' => false, 'message' => null,'data' => $data);

            } catch (PDOException $ex) {
                $response = array('error' => true, 'message' => 'Ocurrió un error al intentar extraer los datos','data' => null);
            }
        }
        
        return json_encode($response);
    }
    
    public static function get_rand_offices ($connection, $limit) {
        $response = array('error' => true, 'message' => 'No hay conexión a la base de datos','data' => null);
        
        if (isset($connection)) {
            try {

                $statement = $connection->prepare(SELF::$SQL_GET_RANDOM_OFFICES);
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
    
    public static function insert_office ($connection, $city_name, $address, $phone, $maps_url, $image_url) {
        $response = array('error' => true, 'message' => 'No hay conexión a la base de datos','data' => null);
        
        if (isset($connection)) {
            try {

                $statement = $connection->prepare(SELF::$SQL_INSERT_OFFICE);
                $statement->bindParam(':p_city_name', $city_name, PDO::PARAM_STR);
                $statement->bindParam(':p_address', $address, PDO::PARAM_STR);
                $statement->bindParam(':p_phone', $phone, PDO::PARAM_STR);
                $statement->bindParam(':p_maps_url', $maps_url, PDO::PARAM_STR);
                $statement->bindParam(':p_image_url', $image_url, PDO::PARAM_STR);
                $statement->execute();
                $data = $connection->lastInsertId();

                $response = array('error' => false, 'message' => 'Se ha insertado de forma correcta','data' => $data);

            } catch (PDOException $ex) {
                $response = array('error' => true, 'message' => 'Ocurrió un error al intentar insertar los datos' . $ex->getMessage(),'data' => null);
            }
        }
        
        return json_encode($response);
    }

    public static function delete_office ($connection, $clv) {
        $response = array('error' => true, 'message' => 'No hay conexión a la base de datos','data' => null);
        
        if (isset($connection)) {
            try {

                $statement = $connection->prepare(SELF::$SQL_DELETE_OFFICE);
                $statement->bindParam(':p_clv', $clv, PDO::PARAM_INT);
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