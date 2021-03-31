<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\BladeEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Libraries\Authentication\Authenticate;
use App\Http\Models\Category;
use App\Http\Models\Page;
use MiladRahimi\PhpRouter\Url;

class PagesController
{
    /*
     * Create the structure like so.
     * index: this is the first view the viewers see
     * create : this is a view for the forms  to be displayed
     * store: this method is used to allow for the create() data to be stored this will be a post request.
     * like create edit will display the form but will be taken by pulling an id.
     * like store update will update the information from edit this will be a post request
     * delete : this will delete the data by id
     */

    public function index(Url $url)
    {
        $articles = Page::All();
        echo BladeEngine::View("Pages.Admin.Blogs.index", ["articles" => $articles,"url"=>$url]);
    }

    public function create(Url $url)
    {
        $categories = Category::all();
        echo BladeEngine::View("Pages.Admin.Blogs.NewBlog",["url"=>$url,"categories"=>$categories]);
    }

    public function store(Url $url)
    {
        $article = new Page();
        $validate = new Validate();
        $article->user_id = Auth::id();
        $article->category_id = $validate->Post('category');
        $article->title = $validate->Required("title")->Post();
        $article->slug = str_replace(" ", "-", $article->title);
        $article->content = $validate->Required("content")->Post();
        $article->pinned = 0;

        if (Validate::Array_Count($validate::$values) == false) {
            Authenticate::$errmessage = "Please see the valid errors";
        } else {
            $article->save();
            redirect($url->make("admin.pages.home"));
        }
        echo BladeEngine::View("Pages.Admin.Blogs.NewBlog", ["article" => $article, "values" => $validate->values, "message" => Authenticate::$errmessage,"url"=>$url]);
    }

    public function edit($slug,$id,Url $url)
    {
        $id = base64_decode($id);
        $results = Page::where("slug",$slug)->where("id", $id)->get();
        $count = $results->count();
        $article = $results->first();
        echo BladeEngine::View("Pages.Admin.Blogs.EditBlog", ["article" => $article, "count" => $count,"url"=>$url]);
    }

    public function update(Url $url)
    {
        $validate = new Validate();
        $article = Page::find($validate->Post("id"));
        $article->title = $validate->Required("title")->Post();
        $article->slug = str_replace(" ", "-", $article->title);
        $article->content = $validate->Required("content")->Post();
        $article->save();
        redirect($url->make("admin.pages.home"));
    }

    public function delete($slug,$id,Url $url)
    {
//        this will later require a passsword from an admin
        $id = base64_decode($id);
        $article = Page::find($id)->delete();
        redirect($url->make("admin.pages.home"));
    }


}