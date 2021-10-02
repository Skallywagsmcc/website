<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\TemplateEngine;
use App\Http\Libraries\Pagination\LaravelPaginator;
use App\Http\Models\FeaturedImage;
use mbamber1986\Authclient\Auth;
use App\Http\Models\Image;
use App\Http\Models\Profile;
use App\Http\Models\User;
use Laminas\Diactoros\ServerRequest;
use MiladRahimi\PhpRouter\Url;

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

        public function delete($id,$user_id,Url $url)
    {
//        Name of
        $id = base64_decode($id);
        $user_id = base64_decode($user_id);
        $profile = Profile::where("user_id", $user_id)->get()->first();
        $image = Image::where("id", $id);
        $featured = FeaturedImage::where("image_id", $image->get()->first()->id)->get();

        $dir = $_SERVER['DOCUMENT_ROOT'].'/img/uploads/';
//        check for the directory

        if (is_dir($dir)) {
            if (file_exists($dir . $image->get()->first()->name)) {
//                check if the profile_pic id and the image id match
                if ($image->first()->id == $profile->profile_pic) {
                    $profile->profile_pic = null;
                    $profile->save();
                }
//                delete from the file structure
                unlink($dir . $image->get()->first()->name);
//                    delete the image from the database
                $image->delete();
//Delete from featured Requests database.
                if ($featured->count() == 1) {
                    $featured->first()->destroy($featured->id);
                }
                redirect($url->make("auth.admin.images.home"));
            }
        } else {
            echo "No directory";
        }
    }

}