<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Models\Charter;
use App\Http\Models\Image;
use App\Http\traits\ErrorHandling;
use App\Http\traits\FileManager;
use App\Http\traits\Resources;
use mbamber1986\Authclient\Auth;
use MiladRahimi\PhpRouter\Url;

class ChartersController
{

    public $charter;

    public $entity_name;
    public $error;
    public $required;

//    form data

    public $id;
    public $title;
    public $content;
    public $ut;
    public $uc;


//Add traits

    use Resources;
    use FileManager;
    use ErrorHandling;

    public function __construct(Validate $validate)
    {
        $this->entity_name = "page/charter";

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->id = $validate->Post("id");
            $this->title = $validate->Post("title");
            $this->content = $validate->Post("content");

            $this->ut = $validate->Post("update_thumb");
            $this->uc = $validate->Post("updated_cover");
        }
    }

    public function index(Url $url)
    {
        $charters = Charter::all();
        echo TemplateEngine::View("Pages.Backend.Charters.index", ["url" => $url, "charters" => $charters, "request" => $this]);
    }


    public function create(Url $url)
    {

        echo TemplateEngine::View("Pages.Backend.Charters.new", ["url" => $url]);
    }

    public function store(Url $url, Validate $validate, Csrf $csrf, Auth $auth)
    {

        $validate->AddRequired(["title", "content"]);
        $this->UploadDir();

        if ($csrf->Verify() == true) {
            if ($validate->Allowed() == false) {
                $this->error = "Missing fields";
                $this->required = $validate->is_required;
            } elseif ($this->EmptyFIle("thumb") == true) {
                $this->error = "Thumnbnail has not been uploaded Please add one";
            } elseif ($this->IsSupported("thumb", ["png", "jpeg", "jpg"]) == false) {
                $this->error = "It seems you have tried to upload an unsuppored file format as a thumbnail";
            } //            this will check if the cover is using the correct format
            elseif (($this->EmptyFIle("cover") == false) && ($this->IsSupported("cover", ["png", "jpeg", "jpg"]) == false)) {
                $this->error = "It seems you have tried to upload an unsuppored file format as a cover image";
            } else {
//                Upload images
                $id = Charter::all()->last()->id + 1;
                //        Error check
                if ($this->upload("thumb") == true) {
                    $thumb = new Image();
                    $thumb->user_id = $auth->id();
                    $thumb->entity_name = $this->entity_name;
                    $thumb->entity_id = $id;
                    $thumb->imagetype = "thumbnail";
                    $thumb->name = $this->hashed_name;
                    $thumb->type = $this->GetFile("type");
                    $thumb->size = $this->GetFile("size");
                    if ($thumb->save()) {
                        $this->success = true;
                    } else {
                        $this->success = false;
                    }
                } else {
                    $this->error = "File Upload failed";
                }
//                fetch the last image requests made so they can be deleted in case charter doesnt save

                if ($this->EmptyFIle("cover") == false) {
                    if ($this->upload("cover") == true) {
                        $cover = new Image();
                        $cover->user_id = $auth->id();
                        $cover->entity_name = $this->entity_name;
                        $cover->entity_id = $id;
                        $cover->imagetype = "cover";
                        $cover->name = $this->hashed_name;
                        $cover->type = $this->GetFile("type");
                        $cover->size = $this->GetFile("size");
                        $cover->save();
                        $cover_id = $cover->id;
                    } else {
                        $cover_id = null;
                    }
                }


//                Save the charter
                if ($this->success == true) {
                    $charter = new Charter();
                    $charter->user_id = $auth->id();
                    $charter->thumbnail = $thumb->id;
                    $charter->cover = $cover_id;
                    $charter->title = ucwords($this->title);
                    $charter->slug = slug($charter->title);
                    $charter->content = $this->content;
                    $charter->save();
                    redirect($url->make("auth.admin.charters.home"));
                } else {
                    $this->error = "An error Occurred: Charter has not been created";
                }
            }
        } else {
            $this->error = "Csrf token is invalid";
        }
        echo TemplateEngine::View("Pages.Backend.Charters.new", ["url" => $url, "request" => $this]);
    }

    public function edit($id, Url $url)
    {
        $this->id = base64_decode($id);
        $this->charter = Charter::Where("id", $this->id)->get();
        if ($this->charter->count() == 1) {
            $this->charter = $this->charter->first();
        }
        echo TemplateEngine::View("Pages.Backend.Charters.edit", ["url" => $url, "request" => $this]);
    }

    public function update(Url $url, Validate $validate, Csrf $csrf, Auth $auth)
    {
        if ($csrf->Verify() == true) {
            $charter = Charter::where("id", $this->id)->get();
            $validate->AddRequired(["title", "content"]);
            if ($validate->Allowed() == false) {
                $this->error = "Missing fields";
                $this->required = $validate->is_required;
            } elseif ($this->EmptyFIle("thumb") == true) {
                $this->error = "Thumnbnail has not been uploaded Please add one";
            } elseif ($this->IsSupported("thumb", ["png", "jpeg", "jpg"]) == false) {
                $this->error = "It seems you have tried to upload an unsuppored file format as a thumbnail";
            } elseif (($this->EmptyFIle("cover") == false) && ($this->IsSupported("cover", ["png", "jpeg", "jpg"]) == false)) {
                $this->error = "It seems you have tried to upload an unsuppored file format as a cover image";
            } else {
                if ($charter->count() == 1) {

                    $charter = $charter->first();

//                    Delete thumb and reupload;
                    if ($this->EmptyFIle("thumb") == false) {


                        if ($charter->Image()->count() == 1) {
                            if ((file_exists(UPLOAD_DIR . '/' . $charter->image->name))) {
                                $this->rmfile($charter->image->name);
                            } else {
                                echo "cover file doesnt exisit";
                            }
//                        delete from database regardless of if the item exisits
                            Image::destroy($charter->image->id);
                        }

                        if ($this->upload("thumb") == true) {
                            $thumb = new Image();
                            $thumb->user_id = $auth->id();
                            $thumb->entity_name = $this->entity_name;
                            $thumb->entity_id = $charter->id;
                            $thumb->imagetype = "thumbnail";
                            $thumb->name = $this->hashed_name;
                            $thumb->type = $this->GetFile("type");
                            $thumb->size = $this->GetFile("size");
                            $thumb->save();
                        } else {
                            echo "thum nail upload failed";
                        }

                    }


                    /* 1 check the cover image file is empty
                    * 2 Check the database record isnt null
                     * 3 Check the file exisits
                     * 4 Delete the file from storaage
                     *  5 delete from Database
                     *  6 Upload a new thumbnail
                    */
                    if ($this->EmptyFIle("cover") == false) {

                        if ($charter->CoverImage()->count() == 1) {
                            if (!is_null($charter->coverimage)) {
                                if (file_exists(UPLOAD_DIR . '/' . $charter->coverimage->name)) {
                                    $this->rmfile($charter->coverimage->name);
                                } else {
                                    echo "cover file doesnt exisit";
                                }
//                        delete from database regardless of if the item exisits
                                Image::destroy($charter->coverimage->id);
                            }
                        }

                        if ($this->upload("cover") == true) {
                            $cover = new Image();
                            $cover->user_id = $auth->id();
                            $cover->entity_name = $this->entity_name;
                            $cover->entity_id = $charter->id;
                            $cover->imagetype = "cover";
                            $cover->name = $this->hashed_name;
                            $cover->type = $this->GetFile("type");
                            $cover->size = $this->GetFile("size");
                            $cover->save();
                            $cover_id = $cover->id;
                        } else {
                            echo "cover image failed";
                        }
                    } else {
                        $cover_id = null;
                    }

                    $charter->user_id = $auth->id();
                    $charter->thumbnail = $thumb->id;
                    $charter->cover = $cover_id;
                    $charter->title = ucwords($this->title);
                    $charter->slug = slug($charter->title);
                    $charter->content = $this->content;
                    $charter->save();
                } else {
                    echo "Not found";
                }
            }
            redirect($url->make("auth.admin.charters.edit", ["id" => base64_encode($this->id)]));
        } else {
            $this->error = "Csrf Vali";
        }
        echo TemplateEngine::View("Pages.Backend.Charters.edit", ["url" => $url, "request" => $this]);
    }

    public function delete(Url $url, $id)
    {
        $id = base64_decode($id);
        $charters = Charter::where("id", $id);

        if ($charters->count() == 1) {
            $charter = $charters->get()->first();
            if ($charter->Image()->count() == 1) {
                $this->rmfile($charter->Image->name);
            }

            if ($charter->CoverImage()->count() == 1) {
                $this->rmfile($charter->CoverImage->name);
            }
            Image::where("entity_name", $this->entity_name)->where("entity_id", $charter->id)->delete();
            $charters->delete();
            redirect($url->make("auth.admin.charters.home"));
        }
    }

}