<?php


trait HasAttributes{

    protected $attributes = [];

    protected $fields = [];

    protected $fillable = [];

    protected $attributes_count;

    function GetAttribute($key){
        if(! isset($this->attributes[$key]))
            throw new \App\Exceptions\NullValue("Cannot find {$key}");

        return $this->attributes[$key];
    }

    function SetAttribute($key, $value){
        if(! isset($this->attributes[$key]))
            throw new \App\Exceptions\NullValue("Cannot find {$key}");

        $this->attributes[$key] = $value;
    }

    function SyncAttributes(){

    }

}

?>