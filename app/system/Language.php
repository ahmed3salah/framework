<?php

namespace App;


class Language{

    public static $Lang = 'en';

    public static function SetLangauge($lang){
        self::$Lang = $lang;

        return true;
    }


}