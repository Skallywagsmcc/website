<?php
namespace App\Http\Controllers;

class SystemController
{

    public $ini_file;
    public $file;
    public function __construct()
    {
        $this->ini_file = $_SERVER['DOCUMENT_ROOT'] . '/System/Services.ini';
//        Parse ini
    }

    public function parsefile($bool,$file=null)
{
    if(!is_null($file))
    {
        $this->ini_file =  $_SERVER['DOCUMENT_ROOT'] . "/System/$file.ini";
    }

     return  parse_ini_file($this->ini_file,$bool);
}

    public function readini($group,$child)
    {
        $group = str_replace("\n\n","<br>",$group);
        $child = str_replace("\n\n","<br>",$child);
        return $this->parsefile(true)[$group][$child];
    }





}