<?php


class Response{


    public static function Json(array $array){
        return json_encode($array);
    }

    public static function Redirect($url, $statusCode = 303){
        header("Location:{$url}", true, $statusCode);
        die();
    }

}