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
use MiladRahimi\PhpRouter\Url;

class ArticlesController
{

    public $title;
    public $content;
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

    public function store(Url $url, Auth $auth, Csrf $csrf, Filemanager $filemanager,Validate $validate)
    {


        $validate->AddRequired(["title","Content"]);
        if ($csrf->Verify() == true) {
            $count = Article::where("slug", slug($this->title))->get()->count();
            if ($count == 1) {
                $error = "this post already Exisits";
            }
            elseif ($validate->allowed == false) {
                $error = "Required Fields are missing";
                $rmf = $validate->is_required;
                print_r($rmf);
            }
            else {
                echo "No Results";

//                $filemanager->validformat(["png", "jpg", "jpeg"])->AddDir("img/uploads/")->upload("thumb");
//
//                if ($filemanager->success == true) {
//                    $cover = new Image();
//                    $cover->user_id = $auth->id();
//                    $cover->entry_name = "Images";
//                    $cover->nvtug = 1;
//                    $cover->title = "Article Thumnail : " . str_replace(" ", "-", $this->title);
//                    $cover->name = $filemanager->GetUniqueName();
//                    $cover->size = $filemanager->GetFile("size");
//                    $cover->type = $filemanager->GetFile("type");
//                    $cover->description = $this->content;
//                    $cover->save();
//                }
//
//                $article = new Article();
//                $article->user_id = $auth->id();
//                $article->entry_name = "Articles";
//                $article->thumb = $image->id;
//                $article->title = $this->title;
//                $article->slug = str_replace(" ", "-", $this->title);
//                $article->content = $this->content;
//                if($article->save())
//                {
//                    redirect($url->make("auth.admin.articles.home"));
//                }
            }
        }

        echo TemplateEngine::View("Pages.Backend.AdminCp.Articles.new", ["article" => $article, "url" => $url, "error" => $error,"rmf"=>$rmf,]);
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

    public function update(Url $url, Validate $validate, Csrf $csrf)
    {

        if ($csrf->Verify() == true) {
            $article = Article::find($validate->Post("id"));
            $article->title = $validate->Required("title")->Post();
            $article->slug = str_replace(" ", "-", $article->title);
            $article->content = $validate->Required("content")->Post();
            $article->save();

            redirect($url->make("auth.admin.articles.home"));
        }
    }


    public function delete($id, Url $url)
    {
//        this will later require a passsword from an admin
        $id = base64_decode($id);
        $article = Article::find($id)->delete();
        redirect($url->make("auth.admin.articles.home"));
    }


}