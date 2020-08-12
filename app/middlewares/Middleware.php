<?php

namespace App\Middlewares;

use App\Controller;
use Exception;

class Middleware{

    protected static $Global_Middlewares = [];

    protected function deny($message, $errorCode = 403){
        echo "Error {$errorCode} : {$message}";
        return false;
    }

    protected function denyWithView($view){
        return view($view);
    }

    public STATIC function GLOBAL_MIDDLEWARE(){
        # Run the global middlewares
        foreach(self::$Global_Middlewares as $middleware){
            $middleware = "{$middleware}";
            # create object form the middleware
            $middleware = new $middleware();
            # run the next method
            if(! $middleware->next()) return false; 
        }

        # finished processing the all middlewares and all of them successful
        return true;
    }

    public static function Add_GLOBAL_MIDDLEWARE($middleware){            
        self::$Global_Middlewares[] = "App\\Middlewares\\{$middleware}";
        return true;
    }

}



?>