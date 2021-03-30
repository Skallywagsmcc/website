<?php


namespace App\Http\Models;


use App\Http\Controllers\Controller;

class Page extends Controller
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}