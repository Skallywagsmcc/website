<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Models\Address;
use App\Http\Models\Event;
use App\Http\Models\Image;
use App\Http\traits\Resources;
use App\Http\traits\Users;
use mbamber1986\Authclient\Auth;
use mbamber1986\Filemanager\Filemanager;
use MiladRahimi\PhpRouter\Url;

class EventsController
{
    use Resources;
    use \App\Http\traits\FileManager;
    use Users;

    public $thumbnail;
    public $error;
    public $cover;

//    Post methods

    public $id;
    public $title;
    public $description;
    public $upload_thumb;
    public $request;
    public $entity_name;


    public function __construct(Validate $validate)
    {
        $this->cover = true;
//        todo rewrite variables
        $this->error = [];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->id = $validate->Post("id");
            $this->title = $validate->Post("title");
            $this->description = $validate->Post("content");
        }
        $this->entity_name = "page/events";
    }

    public function index(Url $url, $message = null)
    {
        $events = Event::all();
        echo TemplateEngine::View("Pages.Backend.Events.index", ["events" => $events, "url" => $url, "request" => $this]);
    }

    public function show(Url $url)
    {
    }

    public function create(Url $url)
    {
        $addresses = Address::where("entity_name", $this->entity_name)->get();
        echo TemplateEngine::View("Pages.Backend.Events.new", ["url" => $url, "addresses" => $addresses, "request" => $this]);
    }

    public function store(Url $url, Auth $auth, Validate $validate, Csrf $csrf)
    {
        $addresses = Address::all();
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
                $id = Event::all()->last()->id + 1;

                if ($this->EmptyFIle("thumb") == false) {
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
                }

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

                if ($this->success == true) {
                    $event = new Event();
                    $event->user_id = $auth->id();//
                    $event->title = ucwords($this->title);
                    $event->thumbnail = $thumb->id;
                    $event->cover = $cover_id;
                    $event->slug = slug($event->title . '-' . microtime());
                    $event->content = $this->description;

                    $event->start_at = $validate->Required("start")->Post();
                    $event->end_at = $validate->Required("end")->Post();
//                Meet_id;
                    $event->meet_id = $validate->Post("meet_id");
//            Dest_id
                    $event->dest_id = $validate->Post("dest_id");
                    $event->map_url = $validate->Post("map_url");
                    $event->save();
                    redirect($url->make("auth.admin.events.home"));
                }


            }
        } else {
            $this->error = "Csrf token doesnt match";
        }
        echo TemplateEngine::View("Pages.Backend.Events.new", ["url" => $url, "validate" => $validate, "values" => Validate::$values, "addresses" => $addresses, "error" => $this->error]);
//        }
    }

    public function Error($property, $string)
    {
        if ($property == false) {
            return $this->error[] = $string;
        }
    }

    public function edit(Url $url, $id, Validate $validate)
    {
        $id = base64_decode($id);
        $event = Event::find($id);
        $addresses = Address::all();
        echo TemplateEngine::View("Pages.Backend.Events.edit", ["event" => $event, "url" => $url, "addresses" => $addresses]);
    }

    public function update(Validate $validate, Auth $auth, Url $url, Csrf $csrf, Filemanager $filemanager)
    {

        $this->UploadDir();
//        Variables
        if ($csrf->Verify() == true) {
            $this->request = Event::where("id", $this->id)->get();

            if ("1+1" == 2) {
                echo "coool";
            } else {
                if ($this->request->count() == 1) {
                    $this->request = $this->request->first();



                    if ($this->EmptyFIle("thumb") == false) {


                        if ($this->request->Image()->count() == 1) {
                            if ((file_exists(UPLOAD_DIR . '/' . $this->request->image->name))) {
                                $this->rmfile($this->request->image->name);
                            } else {
                                echo "cover file doesnt exisit";
                            }
//                        delete from database regardless of if the item exisits
                            Image::destroy($this->request->image->id);
                        }

                        if ($this->upload("thumb") == true) {
                            $thumb = new Image();
                            $thumb->user_id = $auth->id();
                            $thumb->entity_name = $this->entity_name;
                            $thumb->entity_id = $this->request->id;
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

                        if ($this->request->CoverImage()->count() == 1) {
                            if (!is_null($this->request->coverimage)) {
                                if (file_exists(UPLOAD_DIR . '/' . $this->request->coverimage->name)) {
                                    $this->rmfile($this->request->coverimage->name);
                                } else {
                                    echo "cover file doesnt exisit";
                                }
//                        delete from database regardless of if the item exisits
                                Image::destroy($this->request->coverimage->id);
                            }
                        }

                        if ($this->upload("cover") == true) {
                            $cover = new Image();
                            $cover->user_id = $auth->id();
                            $cover->entity_name = $this->entity_name;
                            $cover->entity_id = $this->request->id;
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



                    $this->request->slug = slug($this->request->title);
                    $this->thumbnail == true ? $this->request->thumbnail = $image->id : false;
//                    $this->request->cover = $cover->id;
                    $this->request->content = $validate->Post("content");
                    if ($validate->Post("ms") == 1) {
                        $this->request->start_at = $validate->Required("start")->Post();
                    }
                    if ($validate->Post("me") == 1) {
                        $this->request->end_at = $validate->Required("end")->Post();
                    }
//                Meet_id;
                    $this->request->meet_id = $validate->Post("meet_id");
//            Dest_id
                    $this->request->dest_id = $validate->Post("dest_id");
                    $this->request->map_url = $validate->Post("map_url");
                    $this->request->save();
                    redirect($url->make("auth.admin.events.home"));
                } else {
                    $this->error = "No Results found";
                }
            }

        } else {
            $this->error = "Csrf Token is invalid";
        }

        echo $this->error;
    }

    public function delete(Url $url, Csrf $csrf, Validate $validate, Auth $auth)
    {
        if ($csrf->Verify() == true) {
            if ($auth->RequirePassword($validate->Post("password")) == true) {
                $id = $validate->Post("id");

                if ($id) {
                    for ($i = 0; $i < count($id); $i++) {
                        $event = Event::where("id", $id[$i])->get()->first();
                        Event::destroy($id[$i]);
                        if ($event->image()->count() == 1) {
                            Image::destroy($event->image->id);
                            if (unlink(UPLOAD_DIR . "/" . $event->image->name) == false) {
                                $$this->error[] = "image could not be delete";
                            }
                        }

                        if ($event->Cover()->count() == 1) {
                            Image::destroy($event->Cover->id);
                            if (unlink(UPLOAD_DIR . "/covers/" . $event->Cover->name) == false) {
                                $this->error[] = "Cover could not be deleted";
                            }
                        }

                        redirect($url->make("auth.admin.events.home"));
                    }
                } else {
                    $this->error[] = "You must select at least one item";

                }
            } else {
                $this->error[] = "Your Password Has been entered Wrong, Please try again";
            }
        }

        $events = Event::all();
        echo TemplateEngine::View("Pages.Backend.Events.index", ["events" => $events, "url" => $url, "error" => $this->error]);
    }

}