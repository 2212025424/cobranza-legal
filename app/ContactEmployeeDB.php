<?php

class ContactEmployeeDB {
    
    private static $SQL_GET_EMPLOYEES_CONTACT = "SELECT cc.name as name, ce.url_contact FROM category_contact cc INNER JOIN contact_employee ce ON cc.clv = ce.clv_contact WHERE ce.clv_employee = :p_clv ORDER BY ce.clv";
    private static $SQL_INSERT_EMPLOYEE_CONTACT = "INSERT INTO contact_employee(clv_contact, clv_employee, url_contact) VALUES (:p_clv_contact, :p_clv_employee, :p_url_contact)";
    private static $SQL_DELETE_EMPLOYEE_CONTACT = "DELETE FROM contact_employee WHERE clv_employee = :p_clv";
    
    public static function get_employees_contact ($connection, $clv) {
        $response = array('error' => true, 'message' => 'No hay conexión a la base de datos','data' => null);
        
        if (isset($connection)) {
            try {

                $statement = $connection->prepare(SELF::$SQL_GET_EMPLOYEES_CONTACT);
                $statement->bindParam(':p_clv', $clv, PDO::PARAM_INT);
                $statement->execute();
                $data = $statement->fetchAll();

                $response = array('error' => false, 'message' => null,'data' => $data);

            } catch (PDOException $ex) {
                $response = array('error' => true, 'message' => 'Ocurrió un error al intentar extraer los datos','data' => null);
            }
        }
        
        return json_encode($response);
    }

    public static function insert_employee_contact ($connection, $clv_contact, $clv_employee, $url_contact) {
        $response = array('error' => true, 'message' => 'No hay conexión a la base de datos','data' => null);
        
        if (isset($connection)) {
            try {

                $statement = $connection->prepare(SELF::$SQL_INSERT_EMPLOYEE_CONTACT);
                $statement->bindParam(':p_clv_contact', $clv_contact, PDO::PARAM_INT);
                $statement->bindParam(':p_clv_employee', $clv_employee, PDO::PARAM_INT);
                $statement->bindParam(':p_url_contact', $url_contact, PDO::PARAM_STR);
                $statement->execute();
                $data = $statement->fetchAll();

                $response = array('error' => false, 'message' => null,'data' => $data);

            } catch (PDOException $ex) {
                $response = array('error' => true, 'message' => 'Ocurrió un error al intentar insertar los datos' . $ex->getMessage(),'data' => null);
            }
        }
        
        return json_encode($response);
    }
    public static function delete_employee_contact ($connection, $clv) {
        $response = array('error' => true, 'message' => 'No hay conexión a la base de datos','data' => null);
        
        if (isset($connection)) {
            try {

                $statement = $connection->prepare(SELF::$SQL_DELETE_EMPLOYEE_CONTACT);
                $statement->bindParam(':p_clv', $clv, PDO::PARAM_INT);
                $statement->execute();
                $data = $statement->fetchAll();

                $response = array('error' => false, 'message' => null,'data' => $data);

            } catch (PDOException $ex) {
                $response = array('error' => true, 'message' => 'Ocurrió un error al intentar insertar los datos' . $ex->getMessage(),'data' => null);
            }
        }
        
        return json_encode($response);
    }

}

?>