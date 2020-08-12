<?php

namespace App;

use App\Exceptions\CannotFindController;
use App\LoginController;
use App\Middlewares\Middleware;
use App\Middlewares\ProcessMessages;
use Exception;

class Router{

    # all the routes in the website
    public static array $Routes = [];
    
    public function ProcessRoutes($requested_route){
        if(is_array(self::$Routes) && count(self::$Routes) > 0){
            foreach(self::$Routes as $route){
                if($route['url'] === $requested_route){
                    $controller_class = $route['controller'];
                    $controller_name = "\\App\\{$controller_class}";
                    $method = $route['method'];

                    if(class_exists($controller_class)){
                        throw(new CannotFindController);
                    }

                    # process the global middleware
                    if(! Middleware::GLOBAL_MIDDLEWARE()) return false;

                    # middleware layer
                    if(isset($route['middlewares']) === TRUE){
                        foreach($route['middlewares'] as $middleware){
                            $middleware = "App\\Middlewares\\{$middleware}";

                            $middleware = new $middleware();
                            
                            if(! $middleware->next()){
                                return false;
                            }
                            
                        }
                    }

                    # create instance of the controller
                    $controller = new $controller_name();

                    # run the method
                    $controller->$method();

                    $Process_messages = new ProcessMessages();
                    if(! $Process_messages->next()) {
                        return false;
                    }

                    return true;
                }
            }

            Controller::error(404);
            return false;
        }

        Controller::error(500);
        return false;
    }

    public static function new($url ,$controller, $method){
        $route = new Route();

        return $route->Add($url, $controller, $method);        
    }

}
