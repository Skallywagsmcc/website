<?php


namespace App\Http\Models;


use App\Http\Controllers\Controller;
use App\Http\Controllers\PageController;

class Category extends Controller
{

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function page()
    {
        return $this->hasOne(Page::class);
    }

}