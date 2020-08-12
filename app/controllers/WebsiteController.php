<?php

namespace App;

use App\system\File;

# انا عامل الكنترولر ده علشان يعرض صفحه هوم وصفحه ابوت
class websiteController extends Controller{


    # الداله دي بتعرض صفحه هوم
    public function index(){
        View('home');
    }

    # الداله الي انا هعملها هنا هتعرض صفحه ابوت
    public function about(){
        View('about');
    }

    public function results(){
        View('results');
    }

    public function news(){
        View('news');
    }

    public function contact_us(){
        View('contact_us');
    }
}



?>