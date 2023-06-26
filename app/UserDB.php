<?php

class UserDB {

    private static $SQL_GET_USER_BY_NAME = "SELECT clv, name, password FROM user WHERE name = :p_name LIMIT 1";
    
    public static function get_user_by_name ($connection, $name) {
        $response = array('error' => true, 'message' => 'No hay conexión a la base de datos','data' => null);
        
        if (isset($connection)) {
            try {

                $statement = $connection->prepare(SELF::$SQL_GET_USER_BY_NAME);
                $statement->bindParam(':p_name', $name, PDO::PARAM_STR);
                $statement->execute();
                $data = $statement->fetch();

                if ($data) {
                    $response = array('error' => false, 'message' => null,'data' => $data);
                }else {
                    $response = array('error' => true, 'message' => 'No existe usuario con ese nombre','data' => null);
                }

            } catch (PDOException $ex) {
                $response = array('error' => true, 'message' => 'Ocurrió un error al intentar extraer los datos','data' => null);
            }
        }
        
        return json_encode($response);
    }

}

?>