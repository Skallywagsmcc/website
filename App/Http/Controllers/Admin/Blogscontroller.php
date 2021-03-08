<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\BladeEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Authenticate;
use App\Http\Models\Blog;
use Jenssegers\Blade\Blade;

class Blogscontroller
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
        $blogs = Blog::All();
        echo BladeEngine::View("Pages.Admin.Blogs.index",["blogs"=>$blogs]);
    }

    public function create()
    {

        echo BladeEngine::View("Pages.Admin.Blogs.NewBlog");
    }

    public function store()
    {
        $blog = new Blog();
        $validate = new Validate();
        $blog->title = $validate->Required("title")->Post();
        $blog->slug = str_replace(" ","-",$blog->title);
        $blog->content = $validate->Required("content")->Post();
        $blog->user_id = 1;

        if($validate->data == false)
        {
            Authenticate::$errmessage = "Please see the valid errors";
        }
        else
        {
            $blog->save();
            header("location:/admin/blog");
        }
        echo BladeEngine::View("Pages.Admin.Blogs.NewBlog",["blog"=>$blog,"values"=>$validate->values,"message"=>Authenticate::$errmessage]);
    }

    public function edit($id)
    {
        $results = Blog::where("id",$id)->get();
        $count = $results->count();
        $blog = $results->first();
        echo BladeEngine::View("Pages.Admin.Blogs.EditBlog",["blog"=>$blog,"count"=>$count]);
    }

    public function update()
    {
        $validate = new Validate();
        $blog = Blog::find($validate->Post("id"));
        $blog->title = $validate->Required("title")->Post();
        $blog->slug = str_replace(" ","-",$blog->title);
        $blog->content = $validate->Required("content")->Post();
        header("location:/admin/blog");
    }

    public function delete($id)
    {
        $blog = Blog::find($id)->delete();
        header("location:/admin/blog");
    }

    

}