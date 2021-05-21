<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Libraries\Authentication\Authenticate;
use App\Http\Libraries\Authentication\Cookies;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Libraries\ImageManager\Images;
use App\Http\Libraries\Pagination\LaravelPaginator;
use App\Http\Models\Image;
use App\Http\Models\Article;
use MiladRahimi\PhpRouter\Url;

class ArticlesController
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
        $articles = Article::All();
        echo TemplateEngine::View("Pages.Admin.Blogs.index", ["articles" => $articles, "url" => $url]);
    }

    public function create(Url $url)
    {
        echo TemplateEngine::View("Pages.Admin.Blogs.NewBlog", ["url" => $url]);
    }

    public function store(Url $url, Validate $validate, Images $images, Csrf $csrf)
    {
        if ($csrf->Verify() == true) {
            $count = Article::where("slug", slug($validate->Post("title")))->get()->count();

            if ($count == 1) {
                echo "this title exisits";
                exit();
            } else {
                $article = new Article();
                $article->user_id = Auth::id();
                $article->title = $validate->Required("title")->Post();
                echo $article->title;
                $article->slug = str_replace(" ", "-", $article->title);
                $article->content = $validate->Required("content")->Post();
                $article->save();


                if ($validate->Post('images') == 1) {
                    $images->upload()->ValidFileType(["jpg", "png", "bmp", "gif"])->Save($article->id, function ($id, $i) use ($validate,$article,$csrf,$images) {
                        $name = Images::Files("name")[$i];
                        $tmp = Images::Files("tmp_name")[$i];
                        $size = Images::Files("size")[$i];
                        $type = Images::Files("type")[$i];
                        $ext = Images::pathparts($name)["extension"];
                        if (in_array($ext, Images::$ValidType)) {
                            Images::set_hashed_name($name);
                            move_uploaded_file($tmp, Images::$upload_dir . Images::get_hashed_name($name));
                            $image = new Image();
                            $image->article_id = $article->id;
                            $image->image_name = Images::get_hashed_name($name);
                            $image->title = "new title";
                            $image->description = "A lot of pictures";
                            $image->image_size = $size;
                            $image->image_type = $type;
                            $image->save();
                        } else {
                            Images::$values[] = $name;
                        }
                    });
                }
                if ($validate::Array_Count($validate::$values) == false) {
                    Authenticate::$errmessage = "Please see the valid errors";
                } else {
                    $article->save();
                    redirect($url->make("admin.articles.home"));
                }
            }
        }

        echo TemplateEngine::View("Pages.Admin.Blogs.NewBlog", ["article" => $article, "values" => $validate::$values, "message" => Authenticate::$errmessage, "url" => $url, "error" => $error]);
    }

    public function edit($slug, $id, Url $url)
    {

        $id = base64_decode($id);
        $article = Article::where("slug", $slug)->where("id", $id)->get();
        $count = $article->count();
        $article = $article->first();
        $images = $article->images()->where("article_id", $article->id);
        $pages = new LaravelPaginator('10', 'page');
        $images = $pages->paginate($images);
        $links = $pages->page_links();
        echo TemplateEngine::View("Pages.Admin.Blogs.EditBlog", ["article" => $article, "count" => $count, "url" => $url,"images"=>$images,"links"=>$links]);
    }

    public function update(Url $url, Validate $validate, Images $images, Image $image, Csrf $csrf)
    {

        if ($csrf->Verify() == true) {
            $article = Article::find($validate->Post("id"));
            $article->title = $validate->Required("title")->Post();
            $article->slug = str_replace(" ", "-", $article->title);
            $article->content = $validate->Required("content")->Post();
            $article->save();

            $id = $article->id;
            if ($validate->Post("images") == 1) {
                $images->upload()->ValidFileType(["jpg", "png", "jpeg"])->save($id, function ($id, $i) {
//                echo $id;
                    $name = Images::Files("name")[$i];
                    $tmp = Images::Files("tmp_name")[$i];
                    $size = Images::Files("size")[$i];
                    $type = Images::Files("type")[$i];
                    $ext = Images::pathparts($name)["extension"];
                    if (in_array($ext, Images::$ValidType)) {
                        Images::set_hashed_name($name);
                        move_uploaded_file($tmp, Images::$upload_dir . Images::get_hashed_name($name));
                        $image = new Image();
                        $validate = new Validate();
                        $image->user_id = Auth::id();
                        $image->article_id = $id;
                        $image->image_name = Images::get_hashed_name($name);
                        $image->description = "A lot of pictures";
                        $image->image_size = $size;
                        $image->image_type = $type;
                        $image->save();
                    }
//
                });
            }


            redirect($url->make("admin.articles.home"));
        }
    }


    public function deleteimages(Url $url, Validate $validate, Image $image)
    {
        $id = $validate->Post("id");
        for ($i = 0; $i < count($id); $i++) {

            $image->where("id", $id[$i])->delete();
        }
        redirect($url->make("admin.articles.home"));
    }


    public function delete($id, Url $url)
    {
//        this will later require a passsword from an admin
        $id = base64_decode($id);
        $article = Article::find($id)->delete();
        redirect($url->make("admin.articles.home"));
    }


}