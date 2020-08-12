<?php

namespace App;

use Request;
use Session;

class LoginController extends Controller{

    public function show_page(){
        if(Account::IsLogged()){return View('home');}
            

        return View('login');
    }

    public function process(){
        # get the user inputs
        $request = new Request();
        $username = $request->username;
        $password = $request->password;

        /* check the user inputs */
        # check for null inputs
        if($username == null || $password == null || $username == '' || $password == ''){
            return false;
        }

        # start the login process in the model part
        $account = new Account([], $username, $password);

        $account->login();

        return View('home');
    }

    public function logout(){
        Account::logout();

        Session::Message('Logged out successfully');

        return View('home');
    }

}
