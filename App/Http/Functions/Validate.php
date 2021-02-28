<?php


namespace App\Http\Functions;


class Validate
{

    public static $ValidPassword;
    public static $ShowRequirments;
    public $data;
    public $values;
    public $validate;
    public $value;

    public function __construct()
    {
        self::$ValidPassword = false;
    }

    public function Required($value)
    {
        $this->value = $value;
        if (empty($_POST[$this->value])) {
            $this->values[] = $this->value;
            $this->data = false;
        } else {
            $this->data = true;
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
            self::$ValidPassword = false;
            self::$ShowRequirments = true;
        } else {
            self::$ValidPassword = true;
            self::$ShowRequirments = false;
        }
/*This scrip works as a standalone however i need to fix it to support chainloading conventsion*/
//        return $this;
}

