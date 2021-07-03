<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\TemplateEngine;
use App\Http\Libraries\Pagination\LaravelPaginator;
use App\Http\Models\Image;
use App\Http\Models\User;
use Laminas\Diactoros\ServerRequest;
use MiladRahimi\PhpRouter\Url;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImageController
{
    public function index(Url $url)
    {
        $images = Image::orderBy("id","desc");
        $pages = new LaravelPaginator("10","page");
        $images = $pages->paginate($images);
        $links = $pages->page_links();

        echo TemplateEngine::View("Pages.Backend.AdminCp.Images.index", ["url" => $url,"images"=>$images,"links"=>$links]);
    }

    public function search(Url $url, ServerRequest $request)
    {
        $keyword = $request->getQueryParams()['keyword'];
        $images = Image::where("title","LIKE","%$keyword%")->orwhereHas('user', function ($q) use ($keyword) {
            $q->where("username", "$keyword");
        });
        $pages = new LaravelPaginator("5","page");
        $images = $pages->paginate($images);
        $link = $pages->page_links("?keyword=$keyword&");


//        Post request to show number of images username
        echo TemplateEngine::View("Pages.Backend.AdminCp.Images.Search", ["url" => $url, "keyword" => $keyword, "images"=>$images, "pages" => $pages, "link" => $link]);
    }


    public function view($username, $id)
    {
        $id = base64_decode($id);
        $image = User::where("username", $username)->get()->first()->Images()->find($id);

        echo $image->image_name;
        echo '<img src="/img/uploads/' . $image->image_name . '"  class="m-1">';
        echo $users;

    }

    public function delete(Url $url, $id)
    {

    $id = base64_decode($id);
    $images = Image::where("id",$id)->delete();
    redirect($url->make("admin.images.home"));
//        Delete images from this section
//        May add an Activity section.
    }

}