<?php


namespace App\Http\Controllers\Profile;


use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Libraries\ImageManager\Images;
use App\Http\Models\FeaturedImage;
use App\Http\Models\Image;
use App\Http\Models\Profile;
use App\Http\Models\User;
use MiladRahimi\PhpRouter\Url;

class ImageController
{

    public static $uploaderror;

    public function __construct()
    {
        self::$uploaderror = true;
    }

    public function create()
    {

    }

    public function store(Url $url, Images $images, Auth $auth, Csrf $csrf)
    {

        if ($csrf->Verify() == true) {
            $id = User::find($auth::id());
            $images->upload()->ValidFileType(["jpg", "png", "bmp", "gif"])->Save($id, function ($id) use ($profile) {
                $name = Images::Files("name");
                $tmp = Images::Files("tmp_name");
                $size = Images::Files("size");
                $type = Images::Files("type");
                $ext = Images::pathparts($name)["extension"];
                if (in_array($ext, ["jpg", "png", "jpeg"])) {
                    $validate = new Validate();
                    Images::set_hashed_name($name);
                    move_uploaded_file($tmp, Images::$upload_dir . Images::get_hashed_name($name));
                    $image = new Image();
                    $validate = new Validate();
                    $image->user_id = $id->id;
                    $image->image_name = Images::get_hashed_name($name);
                    $image->image_size = $size;
                    $image->image_type = $type;
                    $image->title = $validate->Required("title")->Post();
                    $image->description = $validate->Post("description");
                    $image->save();
                    if($validate->Post("ppic") == 1)
                    {
//                        Fixed must match user_id not id;
                        $profile = Profile::where("user_id",$id->id)->get()->first();
                        $profile->profile_pic = $image->id;
                        $profile->save();
                    }

                } else {
                    Images::$values[] = $name;
                }
            });
            redirect($url->make("profile.home", ["username" => $id->username]));
        }


    }

    public function ProfilePicture(Url $url, $id, Validate $validate, Csrf $csrf)
    {
        if ($csrf->Verify() == true) {
            $id = base64_decode($id);
            $user = User::find(Auth::id());
            $profile = $user->Profile()->where("user_id", $user->id)->get();
            if ($profile->count() == 1) {
                $profile->first()->profile_pic = $id;
                $profile->first()->save();
                redirect($url->make("profile.home", ["username" => $user->username]));
            } else {
                echo "An Error occurred";
            }
        }

    }

    public function CreateFeatured($id)
    {
        $featured = new FeaturedImage();
        $featured->image_id = $id;
        $featured->status = 1;
        $featured->save();
    }

    public function RemoveFeatured($id)
    {
        $featured = FeaturedImage::where("id",$id);
        $featured->delete();
    }

    public function ManageFeatured($id, Url $url)
    {
        $id = base64_decode($id);
        $featured = FeaturedImage::where("image_id",$id);

        if($featured->count() == 0)
        {
            $this->CreateFeatured($id);
        }
        else
        {
            $id = $featured->first()->id;
            $this->RemoveFeatured($id);
        }

        $featured = $featured->get()->first();
        redirect($_SERVER['HTTP_REFERER']);

    }

    public function edit()
    {

    }

    public function update($id)
    {

    }

    public function delete($id)
    {
        $id = base64_decode($id);
        $user = User::where("id", Auth::id());
        if ($user->count() == 1) {
            $image = $user->get()->first()->images($id);
            Image::destroy($id);
//            rmimg($image->get()->first()->image_name);
            redirect("/profile/{$user->get()->first()->username}/gallery");
        }
    }


}