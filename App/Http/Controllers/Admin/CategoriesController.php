<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Models\Category;
use MiladRahimi\PhpRouter\Url;

class CategoriesController
{

    public function index(Url $url)
    {
        $categories = Category::all();
        echo TemplateEngine::View("Pages.Backend.Categories.index",["categories"=>$categories,"url"=>$url]);
    }

    public function create(Url $url)
    {
        echo TemplateEngine::View("Pages.Backend.Categories.create",["url"=>$url]);
    }

    public function store(Url $url,Csrf $csrf)
    {
        if($csrf->Verify() == true) {
            $validate = new Validate();
            $category = new Category();
            $category->user_id = Auth::id();
            $category->title = ucwords($validate->Required("title")->Post());
            $category->slug = slug($category->title);
            $category->save();
            redirect($url->make("admin.category.home"));
        }
    }

//    Needs edit and update

    public function delete(Url $url, $id)
    {
        $id = base64_decode($id);
        Category::destroy($id);
        redirect($url->make("admin.category.home"));
    }


}