<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\TemplateEngine;
use App\Http\Libraries\Pagination\LaravelPaginator;
use App\Http\Models\FeaturedImage;
use App\Http\Models\Image;
use App\Http\Models\Profile;
use App\Http\Models\User;
use Laminas\Diactoros\ServerRequest;
use MiladRahimi\PhpRouter\Url;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImageController
{
    public function index(Url $url)
    {
        $images = Image::orderBy("id", "desc");
        $pages = new LaravelPaginator("10", "page");
        $images = $pages->paginate($images);
        $links = $pages->page_links();
        echo TemplateEngine::View("Pages.Backend.AdminCp.Images.index", ["url" => $url, "images" => $images, "links" => $links]);
    }

    public function search(Url $url, ServerRequest $request)
    {
        $keyword = $request->getQueryParams()['keyword'];
        $images = Image::where("title", "LIKE", "%$keyword%")->orwhereHas('user', function ($q) use ($keyword) {
            $q->where("username", "$keyword");
        });
        $pages = new LaravelPaginator("5", "page");
        $images = $pages->paginate($images);
        $link = $pages->page_links("?keyword=$keyword&");


//        Post request to show number of images username
        echo TemplateEngine::View("Pages.Backend.AdminCp.Images.index", ["url" => $url, "keyword" => $keyword, "images" => $images, "pages" => $pages, "link" => $link]);
    }


    public function view($username, $id, Url $url)
    {
        $id = base64_decode($id);
        $image = User::where("username", $username)->get()->first()->Images()->where("id",$id)->get();
        echo TemplateEngine::View("Pages.Backend.AdminCp.Images.manage", ["url" => $url, "image" => $image]);


    }

    public function delete(Url $url, $id)
    {

        $id = base64_decode($id);
        $image = Image::where("id", $id);
        $profile = Profile::where("user_id",$image->get()->first()->user->id)->get()->first();

//        use to delete any requests with that id.
        $featured = FeaturedImage::where("image_id", $image->get()->first()->id);
        $dir = __DIR__ . "/../../../../img/uploads/";
//        check for the directory

        if (is_dir($dir)) {

            if($image->get()->first()->id == $profile->profile_pic) {
                $profile->profile_pic = null;
                $profile->save();
            }
            if($featured->count()==1)
            {
                $featured->delete();
            }

            unlink($dir.$image->get()->first()->name);
            $image->delete();
            redirect($url->make("auth.admin.images.home"));
        }
        else
        {
            echo "it doesnt exisit";
        }
//        check if the directory Exisits
    }

}