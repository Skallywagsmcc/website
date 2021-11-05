<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use mbamber1986\Authclient\Auth;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Models\Event;
use App\Http\Models\Image;
use mbamber1986\Filemanager\Filemanager;
use MiladRahimi\PhpRouter\Url;

class EventsController
{

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
        echo TemplateEngine::View("Pages.Backend.Events.new", ["url" => $url]);
    }

    public function store(Url $url, Auth $auth, Validate $validate, Csrf $csrf, Filemanager $filemanager)
    {
        echo "its sorted";
        if($csrf->Verify() == true) {
        $filemanager->validformat(["png", "jpg", "jpeg"])->AddDir("img/uploads/")->upload("upload");
            if ($filemanager->success == true) {
                $image = new Image();
                $image->user_id = $auth->id();
                $image->entry_name = "Images";
                $image->nvtug = 1;
                $image->title = "Event Thumnail : " . str_replace(" ", "-", $validate->Required("title")->Post());
                $image->name = $filemanager->GetUniqueName();
                $image->size = $filemanager->GetFile("size");
                $image->type = $filemanager->GetFile("type");
                $image->description = $validate->Post("content");
                $image->save();
            }
                $event = new Event();
                $event->entry_name = "Events";
                $event->user_id = $auth->id();
                $event->title = ucwords($validate->Required("title")->Post());
                $event->thumbnail = $image->id;
                $event->slug = slug($event->title . '-' . microtime());
                $event->content = $validate->Post("content");

                $event->start_at = $validate->Required("start")->Post();
                $event->end_at = $validate->Required("end")->Post();

//                Event Start Location
                $event->esl = trim($validate->Required("esl_name")->Post() . ",");
                $event->esl .= trim($validate->Required("esl_street")->Post() . ",");
                $event->esl .= trim($validate->Required("esl_city")->Post() . ",");
                $event->esl .= trim($validate->Required("esl_county")->Post() . ",");
                $event->esl .= trim($validate->Required("esl_postcode")->Post() . ",");

//                Event end Location
                $event->eel = trim($validate->Required("eel_name")->Post() . ",");
                $event->eel .= trim($validate->Required("eel_street")->Post() . ",");
                $event->eel .= trim($validate->Required("eel_city")->Post() . ",");
                $event->eel .= trim($validate->Required("eel_county")->Post() . ",");
                $event->eel .= trim($validate->Required("eel_postcode")->Post() . ",");

                $event->map_url = $validate->Post("map_url");
                $event->save();
                redirect($url->make("auth.admin.events.home"));

                echo TemplateEngine::View("Pages.Backend.Events.new", ["url" => $url, "validate" => $validate, "values" => Validate::$values, "message" => $images->message]);



        }
    }

    public function edit(Url $url, $id, Validate $validate)
    {
        $id = base64_decode($id);
        $event = Event::find($id);
        $esl = explode(",", $event->esl);
        $eel = explode(",", $event->eel);
        echo TemplateEngine::View("Pages.Backend.Events.edit", ["event" => $event, "esl" => $esl, "eel" => $eel, "url" => $url]);
    }

    public function update(Validate $validate, Auth $auth, Url $url, Csrf $csrf, Filemanager $filemanager)
    {
        if ($csrf->Verify() == true) {

            $id = $validate->Post("id");
            $event = Event::where("id", $id)->get()->first();

            if($validate->Post("update_thumb") == 1)
            {
            $filemanager->validformat(["jpg","png"])->ChangeRoot(UPLOAD_DIR)->AddDir("/")->upload("upload");

                if ($filemanager->success == true) {
//            destroy the current image
                    if($event->image()->count() == 1)
                    {
                        Image::destroy($event->image->id);
//            Unlink the file
                        unlink(UPLOAD_DIR . $event->image->name);
                    }

//            instantiate a new image
                    $image = new Image();
                    $image->user_id = $auth->id();
                    $image->entry_name = "Images";
                    $image->nvtug = 1;
                    $image->title = "Event Thumnail : " . str_replace(" ", "-", $event->title);
                    $image->name = $filemanager->GetUniqueName();
                    $image->size = $filemanager->GetFile("size");
                    $image->type = $filemanager->GetFile("type");
                    $image->description = "Thumbnail image for event " . $event->title;
                    $image->save();
                    $event->thumbnail = $image->id;
                } else {
                    $esl = explode(",", $event->esl);
                    $eel = explode(",", $event->eel);
                    echo TemplateEngine::View("Pages.Backend.Events.edit", ["event" => $event, "esl" => $esl, "eel" => $eel, "url" => $url,"message"=>$filemanager->message]);
                    exit();
              }
            }



            $event->title = ucwords($validate->Required("title")->Post());
            $event->slug = slug($event->title . '-' . microtime());
            $event->content = $validate->Post("content");
            if ($validate->Post("ms") == 1) {
                $event->start_at = $validate->Required("start")->Post();
            }
            if ($validate->Post("me") == 1) {
                $event->end_at = $validate->Required("end")->Post();
            }
            $event->esl = trim($validate->Required("esl_name")->Post() . ",");
            $event->esl .= trim($validate->Required("esl_street")->Post() . ",");
            $event->esl .= trim($validate->Required("esl_city")->Post() . ",");
            $event->esl .= trim($validate->Required("esl_county")->Post() . ",");
            $event->esl .= trim($validate->Required("esl_postcode")->Post() . ",");

            $event->eel = trim($validate->Required("eel_name")->Post() . ",");
            $event->eel .= trim($validate->Required("eel_street")->Post() . ",");
            $event->eel .= trim($validate->Required("eel_city")->Post() . ",");
            $event->eel .= trim($validate->Required("eel_county")->Post() . ",");
            $event->eel .= trim($validate->Required("eel_postcode")->Post() . ",");
            $event->map_url = $validate->Post("map_url");
            $event->save();

            redirect($url->make("auth.admin.events.home"));

        }
    }

    public function delete(Url $url, Csrf $csrf, Validate $validate, Auth $auth)
    {
        if ($csrf->Verify() == true) {
            if ($auth->RequirePassword($validate->Post("password")) == true) {
                $id = $validate->Post("id");
                for ($i = 0; $i < count($id); $i++) {
                    $event = Event::where("id", $id[$i])->get()->first();
                    Event::destroy($id[$i]);
                    if ($event->image()->count() == 1) {
                        Image::destroy($event->image->id);
                        if (unlink(UPLOAD_DIR . $event->image->name) == false) {
                            echo "image could not be delete";
                        }
                    }

                    redirect($url->make("auth.admin.events.home"));
                }
            } else {
                $message = "Your Password Has been entered Wrong, Please try again";

            }
        } else {
            $message = "your Csrf Token is not valid";
        }
//        $events = Event::all();
//        echo TemplateEngine::View("Pages.Backend.Events.index", ["events" => $events, "url" => $url,"message"=>$message]);
    }

}