<?php

class EmployeeDB {
    
    private static $SQL_GET_EMPLOYEES = "SELECT e.clv AS clv, r.name AS rol, e.name AS name, e.description, e.image_url FROM employee e INNER JOIN rol_employee r ON e.clv_rol = r.clv ORDER by e.clv DESC";
    private static $SQL_GET_RANDOM_EMPLOYEES = "SELECT e.clv AS clv, r.name AS rol, e.name AS name, e.description, e.image_url FROM employee e INNER JOIN rol_employee r ON e.clv_rol = r.clv ORDER BY RAND() LIMIT :p_limit";
    private static $SQL_INSERT_EMPLOYEE = "INSERT INTO employee(clv_rol, name, description, image_url) VALUES(:p_rol, :p_name, :p_description, :p_image)";
    private static $SQL_DELETE_EMPLOYEE = "DELETE FROM employee WHERE clv = :p_clv";

    public static function get_employees ($connection) {
        $response = array('error' => true, 'message' => 'No hay conexión a la base de datos','data' => null);
        
        if (isset($connection)) {
            try {

                $statement = $connection->prepare(SELF::$SQL_GET_EMPLOYEES);
                $statement->execute();
                $data = $statement->fetchAll();

                $response = array('error' => false, 'message' => null,'data' => $data);

            } catch (PDOException $ex) {
                $response = array('error' => true, 'message' => 'Ocurrió un error al intentar extraer los datos','data' => null);
            }
        }
        
        return json_encode($response);
    }
    
    public static function get_rand_employees ($connection, $limit) {
        $response = array('error' => true, 'message' => 'No hay conexión a la base de datos','data' => null);
        
        if (isset($connection)) {
            try {

                $statement = $connection->prepare(SELF::$SQL_GET_RANDOM_EMPLOYEES);
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
    
    public static function insert_employee ($connection, $rol, $name, $description, $image) {
        $response = array('error' => true, 'message' => 'No hay conexión a la base de datos','data' => null);
        
        if (isset($connection)) {
            try {

                $statement = $connection->prepare(SELF::$SQL_INSERT_EMPLOYEE);
                $statement->bindParam(':p_rol', $rol, PDO::PARAM_INT);
                $statement->bindParam(':p_name', $name, PDO::PARAM_STR);
                $statement->bindParam(':p_description', $description, PDO::PARAM_STR);
                $statement->bindParam(':p_image', $image, PDO::PARAM_STR);
                $statement->execute();
                $data = $connection->lastInsertId();

                $response = array('error' => false, 'message' => 'Se ha insertado de forma correcta','data' => $data);

            } catch (PDOException $ex) {
                $response = array('error' => true, 'message' => 'Ocurrió un error al intentar insertar los datos' . $ex->getMessage(),'data' => null);
            }
        }
        
        return json_encode($response);
    }
    
    public static function delete_employee ($connection, $clv) {
        $response = array('error' => true, 'message' => 'No hay conexión a la base de datos','data' => null);
        
        if (isset($connection)) {
            try {

                $statement = $connection->prepare(SELF::$SQL_DELETE_EMPLOYEE);
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