<?php


namespace App\Http\Controllers;


use App\Http\Functions\Validate;

class Base
{


    public $username;
    public $email;
    public $password;
    public $confirm;
    public $fn;
    public $ln;


    public function __construct(Validate $validate)
    {
        $this->username = $validate->Post("username");
        $this->email = $validate->Post("email");
        $this->password = $validate->Post("password");
        $this->confirm = $validate->Post("confirm");
        $this->first_name = $validate->Post("first_name");
        $this->last_name = $validate->Post("last_name");
    }


}