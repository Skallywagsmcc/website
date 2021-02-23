<?php


namespace App\Http\Functions;


class Validate
{

    public $data;
    public $values;
    public $validate;
    public $value;


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


    public function Post($value = null)
    {
        if (!is_null($value)) {
            $this->value = $value;
            $this->data = true;
        }
//Will simply post the value out;
        return $_POST[$this->value];
    }

}