<?php


namespace App\Http\Functions;


use MiladRahimi\PhpContainer\Types\Closure;

class Validate
{

    public static $values;
    public $value;

//    New Values
    public $is_required;
    public $allowed = true;


    /*How to use Validation Setup

    *
     * One method of this process is the chainloading method this can be done by using
     *
     * $validate->Required("fieldname")->Post();  Adding in this format will add to an array
     *
     * the only way to pull a true or false value is to do the following
     *
     * if($validate->allowed == false <- this will allow you to turn missing fields true till contrinue;
     *
     *
     * the other way to set up a required field can be done using the $validate->AddRequired(["username","password"]);
     *
     *
     * if($validate->allowed == false  or if($validate->AddRequired($values) == false)
     *
     *both these methods have the same output but are called ina different way
     *


    */

    public function RequestHexKey()
    {
        return bin2hex(random_bytes(35));
    }



    public function Required($value)
    {
        $this->value = $value;
        if (empty($_POST[$this->value])) {
            self::$values[] = $this->value;
//            Add new Values to Require

//            $this will allow to use if($validate->Allowed == false;
            $this->is_required[] = $this->value;
            $this->allowed = false;
        }
        return $this;
    }

//Required in order to post data

    public function Post($value = null)
    {
            if (!is_null($value)) {
                $this->value = $value;
                $this->data = true;
            }
//Will simply post the value out;
            return $_POST[$this->value];
    }

    public function HasStrongPassword($password)
    {
// Validate password strength

        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);
//        $specialChars = preg_match('@[^\w]@', $password);

        if (!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
            return false;
        } else {
           return true;
        }
        /*This scrip works as a standalone however i need to fix it to support chainloading conventsion*/
//        return $this;
    }


//    New Required validation Fields


public function AddRequired($values)
{
    foreach ($values as $value)
    {
            $this->SetRequired($value);
    }

    if($this->allowed == false)
    {
        return false;
    }
    else
    {
        return true;
    }
}

public function SetRequired($values)
{
    if (empty($_POST[$values])) {

        $this->is_required[] = $values;
        $this->allowed = false;
    }
    else
    {
        $this->allowed = true;
    }

}



}


