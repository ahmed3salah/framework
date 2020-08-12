<?php

use App\Router;

$SYSTEM_PATH = "./app/system";
$APP_PATH = './app';
$ROUTES_PATH = './routes';

$CONTROLLERS = $APP_PATH . '/controllers/*.php';
$TRAITS = $APP_PATH . '/system/Traits/*.php';
$MIDDLEWARES = './app/middlewares/*.php';

/** 
 * include the tarits 
 * */ 
foreach(glob($TRAITS) as $trait){
    include_once($trait);
}

/**
 * include the system files
 */
foreach(glob($SYSTEM_PATH.'/*.php') as $system_file){
    include_once($system_file);
} 


/**
 * include the middlewares
 */
include_once('./app/middlewares/Middleware.php');

foreach(glob($MIDDLEWARES) as $Middleware){
    include_once($Middleware);
}


/** 
 * include the routes 
 * */ 
require_once("{$ROUTES_PATH}/Routes.php");

/**
 * include the models
 */

# include the models
foreach(glob($APP_PATH. '/*.php') as $model){
    include_once($model);
}

/** 
 * include the controllers
 * */ 
foreach(glob($CONTROLLERS) as $controller){
    include_once($controller);
}

# load the requested page
$requested_route = $_SERVER['REQUEST_URI'] ?? '/';  // if requested page is null load the home page

$Router = new Router();

$Router->ProcessRoutes($requested_route);

?>