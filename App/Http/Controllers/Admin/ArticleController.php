<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\BladeEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Libraries\Authentication\Authenticate;
use App\Http\Models\Article;

class ArticleController
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

    public function index()
    {
        $articles = Article::All();
        echo BladeEngine::View("Pages.Admin.Blogs.index", ["articles" => $articles]);
    }

    public function create()
    {

        echo BladeEngine::View("Pages.Admin.Blogs.NewBlog");
    }

    public function store()
    {
        $article = new Article();
        $validate = new Validate();
        $article->title = $validate->Required("title")->Post();
        $article->slug = str_replace(" ", "-", $article->title);
        $article->content = $validate->Required("content")->Post();
        $article->user_id = Auth::id();

        if ($validate->data == false) {
            Authenticate::$errmessage = "Please see the valid errors";
        } else {
            $article->save();
            header("location:/admin/blog");
        }
        echo BladeEngine::View("Pages.Admin.Blogs.NewBlog", ["article" => $article, "values" => $validate->values, "message" => Authenticate::$errmessage]);
    }

    public function edit($slug,$id)
    {
        $id = base64_decode($id);
        $results = Article::where("slug",$slug)->where("id", $id)->get();
        $count = $results->count();
        $article = $results->first();
        echo BladeEngine::View("Pages.Admin.Blogs.EditBlog", ["article" => $article, "count" => $count]);
    }

    public function update()
    {
        $validate = new Validate();
        $article = Article::find($validate->Post("id"));
        $article->title = $validate->Required("title")->Post();
        $article->slug = str_replace(" ", "-", $article->title);
        $article->content = $validate->Required("content")->Post();
        $article->save();
        redirect("/admin/blog");
    }

    public function delete($slug,$id)
    {
//        this will later require a passsword from an admin
        $id = base64_decode($id);
        $article = Article::find($id)->delete();
        redirect("/admin/blog");
    }


}