<?php

namespace App\Http\traits;


trait ErrorHandling
{

    public $error;


    public function newerror($string)
    {
        $this->error[] = $string;
//        this can be done manually if needs be by just calling $this->error[] = "value";
    }


    public function displayerror()
    {
        if ($this->error) {
            return false;
        } else {
            return true;
        }

//        Call with a foreach loop
    }
}