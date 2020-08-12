<?php


class Request{



    public function __get($name){
        # check for a get value
        if(isset($_GET[$name])) return $_GET[$name];
        # check for a post value
        if(isset($_POST[$name])) return $_POST[$name];

        throw(new Exception("Cannot find {$name}"));
    }


}