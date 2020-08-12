<?php

namespace App;

use Exception;

class Route{

    # index
    protected $index;

    # URL
    protected $url;

    # CONTROLLER
    protected $controller;

    # METHOD
    protected $method;



    public function Add($url ,$controller, $method){
        $currentRouteIndex = count(Router::$Routes) -1;
        $currentRouteIndex = $currentRouteIndex < 0 ? 0 : $currentRouteIndex;
        $currentRouteIndex = isset(Router::$Routes[$currentRouteIndex]) ? $currentRouteIndex + 1 : $currentRouteIndex;

        Router::$Routes[$currentRouteIndex]['url'] = Config('ROUTE_PREFIX'). $url;
        Router::$Routes[$currentRouteIndex]['controller'] = $controller;
        Router::$Routes[$currentRouteIndex]['method'] = $method;
        Router::$Routes[$currentRouteIndex]['route'] = $this;


        $this->index = $currentRouteIndex;

        return $this;
    }

    public function middleware($Middleware_name){

        if(! class_exists("App\\Middlewares\\{$Middleware_name}")){
            throw (new Exception("Cannot find App\\Middlewares\\{$Middleware_name} middleware"));
            return false;
        }

        Router::$Routes[$this->index]['middlewares'][] = $Middleware_name;

        return $this;
    }

    public function name($name){
        Router::$Routes[$this->index]['name'] = $name;
        
        return $this;
    }

}







?>