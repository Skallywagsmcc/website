<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\traits\Activity_log;
use App\Libraries\Filemanager;
use mbamber1986\Authclient\Auth;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Libraries\Pagination\LaravelPaginator;
use App\Http\Models\Image;
use App\Http\Models\Article;
use Laminas\Diactoros\ServerRequest;
use Migrations\Images;
use MiladRahimi\PhpContainer\Tests\Classes\A;
use MiladRahimi\PhpRouter\Url;

class ArticlesController
{

    use Activity_log;

    public $title;
    public $content;
    public $changethumb;
    protected $isvalid;

    public function __construct(Validate $validate)
    {

        $this->title = $validate->Post("title");
        $this->content = $validate->Post("content");
    }

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

        $articles = Article::All();
        echo TemplateEngine::View("Pages.Backend.AdminCp.Articles.index", ["articles" => $articles, "url" => $url]);
    }

    public function create(Url $url, Auth $auth)
    {

        echo TemplateEngine::View("Pages.Backend.AdminCp.Articles.new", ["url" => $url]);
    }

    public function store(Url $url, Auth $auth, Csrf $csrf,Validate $validate)
    {
        $validate->AddRequired(["title","content"]);
        if ($csrf->Verify() == true) {
            $count = Article::where("slug", slug($this->title))->get()->count();
            if ($count == 1) {
                $error = "this post already Exisits";
            }
            elseif ($validate->Allowed() == false) {
                $error = "Required Fields are missing";
                $rmf = $validate->is_required;
            }
            else {
                $article = new Article();
                $article->user_id = $auth->id();
                $article->title = $this->title;
                $article->slug = str_replace(" ", "-", $this->title);
                $article->content = $this->content;
                $this->addurl("http://".$_SERVER['HTTP_HOST'].$url->make("articles.view",["slug"=>$article->slug]))->newactivity("article","create","true");
                if($article->save())
                {
                    redirect($url->make("auth.admin.articles.home"));
                }
            }
        }

        echo TemplateEngine::View("Pages.Backend.AdminCp.Articles.new", ["article" => $article, "url" => $url, "error" => $error,"rmf"=>$rmf,"post"=>$this]);
    }

//    Search

    public function search(Url $url, ServerRequest $request)
    {
        $keyword = $request->getQueryParams()['keyword'];
        $articles = Article::where("title","LIKE","%$keyword%")->orwherehas("user",function($q) use ($keyword){
            $q->where("username","LIKE","%$keyword%");
        })->get();
        echo TemplateEngine::View("Pages.Backend.AdminCp.Articles.index", ["articles" => $articles, "url" => $url]);

    }

    public function edit($slug, $id, Url $url)
    {
        $id = base64_decode($id);
        $article = Article::where("slug", $slug)->where("id", $id)->get();
        $count = $article->count();
        $article = $article->first();
        echo TemplateEngine::View("Pages.Backend.AdminCp.Articles.edit", ["article" => $article, "count" => $count, "url" => $url, "links" => $links]);
    }

    public function update(Url $url, Validate $validate, Csrf $csrf,$id,$slug,Filemanager $filemanager,Auth $auth)
    {
        $id = base64_decode($id);
        $validate->AddRequired("title","content");
        $article = Article::where("slug",$slug)->where("id",$id)->get();
                $count = $article->count();
                $article = $article->first();
        if ($csrf->Verify() == true) {
                if($validate->Allowed() == false)
            {
                $error = "Required Fields are missing";
                $rmf = $validate->is_required;
           }
            else
            {
                $article->title = $this->title;
                $article->slug = str_replace(" ", "-", $article->title);
                $article->content = $this->content;
                $article->save();
                $this->addurl("http://".$_SERVER['HTTP_HOST'].$url->make("articles.view",["slug"=>$article->slug]))->newactivity("article","update","true");
                redirect($url->make("auth.admin.articles.home"));
            }
            echo TemplateEngine::View("Pages.Backend.AdminCp.Articles.edit", ["article" => $article, "count" => $count, "url" => $url,"error"=>$error,"rmf"=>$rmf,"post"=>$this]);
        }



    }


    public function delete($id, Url $url)
    {
//        this will later require a passsword from an admin
        $id = base64_decode($id);
        $article = Article::find($id)->delete();
        $this->newactivity("article","delete","true");
        redirect($url->make("auth.admin.articles.home"));
    }


}