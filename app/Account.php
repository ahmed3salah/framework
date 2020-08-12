<?php
namespace App;

use Session;

class Account extends Model{

    protected $table = 'accounts';

    protected $username;

    protected $password;

    public function __construct($attributes = null, $username = null, $password = null)
    {
        parent::__construct($attributes);

        $this->username = $username;

        $this->password = $password;
    }

    public function login(){
        // TODD :: activate this line in production
        // $hashed_password = md5($password);

        $hashed_password = $this->password;

        if($this->num_rows("name = '{$this->username}' AND password = '{$hashed_password}'") > 0){
            Session::Set('logged', true);
            
            Session::Message('Logged successfully!');
            return true;
        }

        Session::Error('You have entered wrong username or password');
        return false;
    }

    public static function logout(){
        Session::Set('logged', false);
    }

    public static function IsLogged(){
        return Session::Get('logged') ?? false;
    }
}
?>