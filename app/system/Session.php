<?php


class Session{

    public static function Set($key, $value){
        $_SESSION[$key] = $value;
    }

    public static function Get($key){
        return $_SESSION[$key] ?? null;
    }


    public static function Message($body, $type = 'success'){
        $currentIndex = @count($_SESSION['messages']) -1 ?? 0;
        $currentIndex = $currentIndex < 0 ? 0 : $currentIndex;
        $currentIndex = isset($_SESSION['messages'][$currentIndex]) ? $currentIndex + 1 : $currentIndex;


        $_SESSION['messages'][$currentIndex]['body'] = $body;
        $_SESSION['messages'][$currentIndex]['type'] = $type;

        return $_SESSION['messages'];
    }

    public static function Error($message){
        $_SESSION['errors'][] = $message;
    }
    
    public static function GetErrors(bool $cleanCach = true){
        $errors = $_SESSION['errors'];
        
        if($cleanCach)
            unset($_SESSION['errors']);

        return $errors;
    }

    public static function DisplayErrors(){
        foreach ($_SESSION['errors'] as $error){
            echo $error;
        }

        return true;
    }

    public static function ResetSession(){
        unset($_SESSION);
        
        return true;
    }

    public function __get($name){
        self::Get($name);
    }

    public function __set($name, $value){
        self::Set($name, $value);
    }

    public function __isset($name)
    {
        return isset($_SESSION[$name]);
    }


}




?>