<?php

class Connection {

    private static $connection;

    public static function open_connection () {
        if (!isset(SELF::$connection)) {
            try {
                SELF::$connection = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
                SELF::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                SELF::$connection->exec("SET CHARACTER SET utf8");
            } catch (PDOException $ex) {
                print "ERROR: " . $ex->getMessage() . "<br>";
                die();
            }
        }
    }

    public static function close_connection () {
        if (isset(SELF::$connection)) {
            SELF::$connection = null;
        }
    }

    public static function get_connection () {
        return SELF::$connection;
    }

}

?>