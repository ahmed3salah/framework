<?php

namespace App;

class News extends Model{


    protected $table = 'news';


    # داله مخصوصه للمودل ده
    public function readNews(){
        echo $this->body;
    }
}



?>