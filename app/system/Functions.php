<?php

use App\App;
use App\Middlewares\Middleware;
use App\Router;

/**
     * This file for the most used functions around the website 
     */

    function Config($key, $file = true){
        # include the config file
        $config = $file ? include('./config/config.php') : include($file);
        
        if(isset($config[$key])){
            return $config[$key];
        }
    }

    function RegisterGlobalMiddleware($middlware){
        # register a global middleware
        Middleware::Add_GLOBAL_MIDDLEWARE($middlware);
        
        return true;
    }

    function Route(string $Route_name,bool $print = false, bool $abslouteUrl = true){
        foreach(Router::$Routes as $route){
            if(isset($route['name']) && $route['name'] == $Route_name){
                if(! $print)
                    return ! $abslouteUrl ? $route['url'] : Config('DOMAIN_NAME') . $route['url'];

                echo ! $abslouteUrl ? $route['url'] : Config('DOMAIN_NAME') . $route['url'];
                return true;
            }
        }

        throw(new Exception("Cannot find {$Route_name}"));
    }


    function Lang($key,array $variables = [], $lang = null){
        
        $current_lang = $lang ?? App::GetLang();

        $file_path_array = explode('.', $key);
        
        if(count($file_path_array) > 1){
            $path_array_count = count($file_path_array);
            $path = "./lang/{$current_lang}";

            for($i = 0; $i <= $path_array_count -1; $i++){
                if($i != $path_array_count -1)
                    $path .= "/{$file_path_array[$i]}";
                else
                    $key = $file_path_array[$i]; 
            }

            $path .= '.php';
        }else{
            $path = "./lang/{$current_lang}/app.php";
        }

        $lang_pack = include($path);

        if(isset($lang_pack[$key])){
            return $lang_pack[$key];
        }

        return $key;
    }

    function Request(){
        $info['URL'] =  explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        

        var_dump($info);
        // Display($info);
    }

    // قيم محتمله
    // About , Home

    // لو عملتي فولدر جوا فولدر Views 
    // admin/index
    
    function View(string $path){
        return include('./views/'. $path . '.php');
    }

    function dd($variable){
        Display($variable);
        die();
    }







    /**
     * Functions only for this file
     */
    function Display($variable){
        # if the vairable is an array
        if(is_array($variable))
            foreach($variable as $key => $value){
                echo $key . "=>" . Display($value) . "<br>";
            }
        else
            echo $variable;
    }
