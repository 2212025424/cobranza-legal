<?php

class Session {
    
    public static function start_sesion($user_name){
        if(session_id() == ''){
            session_start();
        }
        $_SESSION['user_name'] = $user_name;
    }
    
    public static function stop_sesion(){
        if(session_id()==''){
            session_start();
        }
        if(isset($_SESSION['user_name'])){
            unset($_SESSION['user_name']);
        }
        session_destroy();
    }
    
    public static function isset_sesion (){
        if(session_id() == ''){
            session_start();
        }
        if (isset($_SESSION['user_name'])) {
            return true;
        } else {
            return false;
        }
    }
}

?>