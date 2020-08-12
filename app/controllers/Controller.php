<?php

namespace App;

class Controller{
 



    public static function error(int $error_code){
        switch($error_code){
            case 404:
                echo '404 Cannot find the page :(';
            break;
            case 500:
                echo '500 INTERNAL SERVER ERROR';
            break;

            default:
                echo 'Unkown error code!';
        break;
        }
    }

}


?>