<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
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

    public $title;
    public $content;
    public $changethumb;
    protected $isvalid;

    public function __construct(Validate $validate)
    {

        $this->title = $validate->Post("title");
        $this->content = $validate->Post("content");
        $this->changethumb = $validate->Post("changethumb");
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

    public function store(Url $url, Auth $auth, Csrf $csrf, Filemanager $filemanager,Validate $validate)
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
                $filemanager->validformat(["png", "jpg", "jpeg"])->AddDir("img/uploads/")->upload("thumb");
                if ($filemanager->success == true) {
                    $image = new Image();
                    $image->user_id = $auth->id();
                    $image->entry_name = "Images";
                    $image->nvtug = 1;
                    $image->title = "Article Thumnail : " . str_replace(" ", "-", $this->title);
                    $image->name = $filemanager->GetUniqueName();
                    $image->size = $filemanager->GetFile("size");
                    $image->type = $filemanager->GetFile("type");
                    $image->description = $this->content;
                    $image->save();
                }
                $article = new Article();
                $article->user_id = $auth->id();
                $article->entry_name = "Articles";
                $article->thumb = $image->id;
                $article->title = $this->title;
                $article->slug = str_replace(" ", "-", $this->title);
                $article->content = $this->content;
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

        $articles = Article::all();
        if ($users->count() == 0) {
            $message = "No Username With that Name has Been found in our database";
        }
        echo TemplateEngine::View("Pages.Backend.AdminCp.articles.index", ["articles" => $articles, "url" => $url, "message" => $message]);


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
        $article = Article::where("slug",$slug)->where("id",$id)->get();
                $count = $article->count();
                $article = $article->first();
        $validate->AddRequired(["title","content"]);
        if ($csrf->Verify() == true) {

                if($validate->Allowed() == false)
            {
                $error = "Required Fields are missing";
                $rmf = $validate->is_required;
           }
            else
            {
                if($this->changethumb == 1) {
                    $images = Image::where("id",$article->thumb);
                        $image = $images->get()->first();
                     unlink($_SERVER['DOCUMENT_ROOT'] . "/img/uploads/".$image->name);
                     $images->delete();

                    $filemanager->validformat(["png", "jpg", "jpeg"])->AddDir("img/uploads/")->upload("thumb");
                    if ($filemanager->success == true) {
                        $image = new Image();
                        $image->user_id = $auth->id();
                        $image->entry_name = "Images";
                        $image->nvtug = 1;
                        $image->title = "Article Thumnail : " . str_replace(" ", "-", $this->title);
                        $image->name = $filemanager->GetUniqueName();
                        $image->size = $filemanager->GetFile("size");
                        $image->type = $filemanager->GetFile("type");
                        $image->description = $this->content;
                        $image->save();
                        $this->isvalid = true;
                    }
                }

                $article->title = $this->title;
                $article->slug = str_replace(" ", "-", $article->title);
                $this->isvalid == true ? $article->thumb=$image->id : $article->thumb = null;
                $article->content = $this->content;
                $article->save();
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
        redirect($url->make("auth.admin.articles.home"));
    }


>>>>>>> 80ccd0fe3134e470ac1e969696bf9513f0d5c7cb
}