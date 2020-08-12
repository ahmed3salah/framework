<?php

namespace App\Middlewares;

use App\Account;

class Auth extends Middleware{

    public function next(){

        if(Account::IsLogged())
            return true;
        
        
        return $this->deny('Cannot access this without loggin in!');
    }

}

?>