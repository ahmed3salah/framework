<?php


namespace App;

use Session;

class App
{

    public static function GetStatus(){
        return Config('APP_STATUS');
    }

    public static function SetLang($lang){
        Session::Set('Lang', $lang);

        Language::SetLangauge($lang);

        return true;
    }

    public static function ResetLang(){
        Session::Set('Lang', Config('DEFAULT_LANG'));
        Language::SetLangauge(Config('DEFAULT_LANG'));

        return true;
    }

    public static function GetLang(){
        return Session::Get('Lang') ?? Config('DEFAULT_LANG');
    }


}
