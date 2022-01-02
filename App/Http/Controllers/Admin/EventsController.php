<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Models\Address;
use App\Http\Models\Event;
use App\Http\Models\Image;
use mbamber1986\Authclient\Auth;
use mbamber1986\Filemanager\Filemanager;
use MiladRahimi\PhpRouter\Url;

class EventsController
{

    public $thumbnail;
    public $error;
    public $cover;

//    Post methods

    public $id;
    public $title;
    public $description;
    public $upload_thumb;
    public $request;


    public function __construct(Validate $validate)
    {
        $this->cover = true;
//        todo rewrite variables
        $this->error = [];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->id = $validate->Post("id");
            $this->title = $validate->Post("title");
            $this->description = $validate->Post("content");
        } else {
        }
    }

    public function index(Url $url, $message = null)
    {
        $events = Event::all();
        echo TemplateEngine::View("Pages.Backend.Events.index", ["events" => $events, "url" => $url]);
    }

    public function show(Url $url)
    {
    }

    public function create(Url $url)
    {
        $addresses = Address::where("contactus", 0)->get();
        echo TemplateEngine::View("Pages.Backend.Events.new", ["url" => $url, "addresses" => $addresses]);
    }

    public function store(Url $url, Auth $auth, Validate $validate, Csrf $csrf, Filemanager $filemanager)
    {
        $addresses = Address::all();
        if ($csrf->Verify() == true) {
//            Do a verification
            $filemanager->validformat(["png", "jpg", "jpeg"])->AddDir("img/uploads/")->upload("thumb");
            if ($filemanager->success == true) {
                if ($filemanager->GetFile("error") != 4) {
                    $image = new Image();
                    $image->user_id = $auth->id();
                    $image->entry_name = "Images";
                    $image->nvtug = 1;
                    $image->title = "Event Thumnail : " . str_replace(" ", "-", $this->title);
                    $image->name = $filemanager->GetUniqueName();
                    $image->size = $filemanager->GetFile("size");
                    $image->type = $filemanager->GetFile("type");
                    $image->description = $this->description;
                    $this->thumbnail = true;
                }
            }


            $filemanager->validformat(["png", "jpg", "jpeg"])->AddDir("img/uploads/covers/")->upload("cover");
            if ($filemanager->success == true) {
                $cover = new Image();
                $cover->user_id = $auth->id();
                $cover->entry_name = "Images";
                $cover->nvtug = 1;
                $cover->title = "Event Thumnail : " . str_replace(" ", "-", $this->title);
                $cover->name = $filemanager->GetUniqueName();
                $cover->size = $filemanager->GetFile("size");
                $cover->type = $filemanager->GetFile("type");
                $cover->description = $this->description;
                $this->cover = 1;
            }
            $this->Error($this->thumbnail, "ThumbNail Image is empty and required");
            $this->Error($this->cover, "Cover image cannot be left empty");
            if ($this->thumbnail == true) {
//                    Save fields
                $image->save();
                $cover->save();


                $event = new Event();
                $event->entry_name = "Events";
                $event->user_id = $auth->id();
                $event->title = ucwords($this->title);
                $event->thumbnail = $image->id;
                $event->cover = $cover->id;
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


//                End else verify
            echo TemplateEngine::View("Pages.Backend.Events.new", ["url" => $url, "validate" => $validate, "values" => Validate::$values, "addresses" => $addresses, "error" => $this->error]);


        }
    }

    public function Error($property, $string)
    {
        if ($property == false) {
            return $this->error[] = $string;
        }
    }

    public function edit(Url $url, $id, Validate $validate)
    {
        echo UPLOAD_DIR;
        $id = base64_decode($id);
        $event = Event::find($id);
        $addresses = Address::all();
        echo TemplateEngine::View("Pages.Backend.Events.edit", ["event" => $event, "url" => $url, "addresses" => $addresses]);
    }

    public function update(Validate $validate, Auth $auth, Url $url, Csrf $csrf, Filemanager $filemanager)
    {

//        Variables
        $filemanager->validformat(["png", "jpg", "jpeg"])->AddDir("img/uploads/")->upload("thumb");
        if ($csrf->Verify() == true) {
            $this->request = Event::where("id", $this->id)->get();
            if ($this->request->count() == 1) {
                $this->request = $this->request->first();
                if ($filemanager->success == true) {
//            destroy the current image
                    if ($this->request->image()->count() == 1) {
                        Image::destroy($this->request->image->id);
//            Unlink the file
                        unlink(UPLOAD_DIR . "/" . $this->request->image->name);
                    }

//            instantiate a new image
                    if ($filemanager->GetFile("error") != 4) {
                        $image = new Image();
                        $image->user_id = $auth->id();
                        $image->entry_name = "Images";
                        $image->nvtug = 1;
                        $image->title = "Event Thumnail : " . str_replace(" ", "-", $this->title);
                        $image->name = $filemanager->GetUniqueName();
                        $image->size = $filemanager->GetFile("size");
                        $image->type = $filemanager->GetFile("type");
                        $image->description = $this->description;
                        $image->save();
                        $this->thumbnail = true;
                    }
                    else
                    {
                        $this->error = "image upload failed";
                        echo $this->error . $filemanager->GetFile("error");
                        exit();
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
                }

            } else {
                $this->error = "No Results found";
            }
        }
        else
        {
            $this->error = "Csrf Token is invalid";
        }

        echo $this->error;
        exit();
        if ($csrf->Verify() == true) {


            $filemanager->validformat(["png", "jpg", "jpeg"])->AddDir("img/uploads/")->upload("thumb");


            if ($validate->Post("update_cover") == 1) {
                $filemanager->validformat(["png", "jpg", "jpeg"])->AddDir("img/uploads/covers/")->upload("cover");

                if ($filemanager->success == true) {
//            destroy the current image
                    if ($event->cover()->count() == 1) {
                        Image::destroy($event->cover->id);
//            Unlink the file
                        unlink(UPLOAD_DIR . "/" . $event->cover->name);
                    }

//            instantiate a new image
                    $cover = new Image();
                    $cover->user_id = $auth->id();
                    $cover->entry_name = "Images";
                    $cover->nvtug = 1;
                    $cover->title = "Event Thumnail : " . str_replace(" ", "-", $event->title);
                    $cover->name = $filemanager->GetUniqueName();
                    $cover->size = $filemanager->GetFile("size");
                    $cover->type = $filemanager->GetFile("type");
                    $cover->description = "Thumbnail image for event " . $event->title;
                }
            }


            if ($this->thumbnail == true) {
                $image->save();
//                $cover->save();

                $event->title = ucwords($this->title);
                $event->slug = slug($event->title . '-' . microtime());
                $event->thumbnail = $image->id;
                $event->cover = $cover->id;
                $event->content = $validate->Post("content");
                if ($validate->Post("ms") == 1) {
                    $event->start_at = $validate->Required("start")->Post();
                }
                if ($validate->Post("me") == 1) {
                    $event->end_at = $validate->Required("end")->Post();
                }
//                Meet_id;
                $event->meet_id = $validate->Post("meet_id");
//            Dest_id
                $event->dest_id = $validate->Post("dest_id");
                $event->map_url = $validate->Post("map_url");
                $event->save();
                redirect($url->make("auth.admin.events.home"));
            } else {
                echo "no saving";
            }


        }
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