<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Models\Address;
use App\Http\Models\Event;
use App\Http\Models\Image;
use App\Http\traits\Activity_log;
use App\Http\traits\FileManager;
use App\Http\traits\Resources;
use App\Http\traits\Users;
use mbamber1986\Authclient\Auth;
use MiladRahimi\PhpRouter\Url;

class EventsController
{
    use Resources;
    use FileManager;
    use Users;
    use Activity_log;

    public $error;
    public $thumb;
    public $cover;
    public $event;
    public $address;
    public $entity_name;
//    Post methods

    public $id;
    public $title;
    public $content;
    public $start_date;
    public $end_date;
    public $meet_id;
    public $dest_id;

    public function __construct(Validate $validate)
    {
        $this->cover = true;
//        todo rewrite variables

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->error = false;
            $this->id = $validate->Post("id");
            $this->title = $validate->Post("title");
            $this->content = $validate->Post("content");
            $this->start_date = $validate->Post("start_date");
            $this->end_date = $validate->Post("end_date");
            $this->meet_id = $validate->Post("meet_id");
            $this->dest_id = $validate->Post("dest_id");
        }
        $this->entity_name = "page/events";
        $this->address = Address::where("entity_name", $this->entity_name)->get();
    }

    public function index(Url $url, $message = null)
    {
        $this->event = Event::all();
        echo TemplateEngine::View("Pages.Backend.Events.index", ["url" => $url, "request" => $this]);
    }

    public function show(Url $url)
    {
    }

    public function create(Url $url)
    {
        echo TemplateEngine::View("Pages.Backend.Events.new", ["url" => $url, "addresses" => $this->address]);
    }

    public function store(Url $url, Auth $auth, Validate $validate, Csrf $csrf)
    {

        $validate->AddRequired(["title", "content", "start_date", "end_date"]);
        $this->UploadDir();

        if ($csrf->Verify() == true) {
            if ($validate->Allowed() == false) {
                $this->error = "Missing fields";
                $this->required = str_replace("_", " ", $validate->is_required);
            } elseif ($this->EmptyFIle("thumb") == true) {
                $this->error = "Thumnbnail has not been uploaded Please add one";
            } elseif ($this->IsSupported("thumb", ["png", "jpeg", "jpg"]) == false) {
                $this->error = "It seems you have tried to upload an unsuppored file format as a thumbnail";
            } elseif ($this->Filesize("thumbail") == false) {
                $this->error = "File upload size for thumbnail image exceeds the value of " . $this->HRFS($this->MFS);
            } //            this will check if the cover is using the correct format
            elseif (($this->EmptyFIle("cover") == false) && ($this->IsSupported("cover", ["png", "jpeg", "jpg"]) == false)) {
                $this->error = "It seems you have tried to upload an unsuppored file format as a cover image";
            } elseif ($this->Filesize("cover") == false) {
                $this->error = "File upload size  for cover image exceeds the value of " . $this->HRFS($this->MFS);
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
                    $this->event = new Event();
                    $this->event->user_id = $auth->id();//
                    $this->event->title = ucwords($this->title);
                    $this->event->slug = slug($this->title);
                    $this->event->thumbnail = $thumb->id;
                    $this->event->cover = $cover_id;
                    $this->event->slug = slug($event->title);
                    $this->event->content = $this->content;

                    $this->event->start_at = $this->start_date;
                    $this->event->end_at = $this->end_date;
//                Meet_id;
                    $this->event->meet_id = $this->meet_id;
//            Dest_id
                    $this->event->dest_id = $this->dest_id;
                    if ($this->event->save())
                        $this->addurl("http://" . $_SERVER['HTTP_HOST'] . $url->make("events.view", ["slug" => $this->event->slug]))->newactivity("event", "create", true);
                    redirect($url->make("auth.admin.events.home"));
                }
            }


        } else {
            $this->error = "Csrf token doesnt match";
        }
        echo TemplateEngine::View("Pages.Backend.Events.new", ["url" => $url, "request" => $this, "addresses" => $this->address]);
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
        $this->event = Event::find($id);
        echo TemplateEngine::View("Pages.Backend.Events.edit", ["url" => $url, "addresses" => $this->address, "request" => $this]);
    }

    public function update($id, Validate $validate, Auth $auth, Url $url, Csrf $csrf)
    {

//        Set Requirements
        $validate->AddRequired(["title", "content", "start_date", "end_date"]);
        $this->UploadDir();
//        Detect the id via post method
        $event = Event::where("id", $this->id)->get();


//       end Requirements
        if ($event->count() == 1) {
            $event = $event->first();
//      Check Csrf Token
            if ($csrf->Verify() == true) {
//                Verification
                if ($validate->Allowed() == false) {
                    $this->error = "Missing fields";
                    $this->required = str_replace("_", " ", $validate->is_required);
                } elseif (($this->EmptyFIle("thumb") == false) && ($this->IsSupported("thumb", ["png", "jpeg", "jpg"]) == false)) {
                    if ($this->Filesize("thumb") == false) {
                        $this->error = "File upload size for thumbnail exceeds the value of " . $this->HRFS($this->MFS);
                    } else {
                        $this->error = "It seems you have tried to upload an unsuppored file format as a cover image";
                    }
                } //            this will check if the cover is using the correct format and correct file size
                elseif (($this->EmptyFIle("cover") == false) && ($this->IsSupported("cover", ["png", "jpeg", "jpg"]) == false)) {
                    if ($this->Filesize("cover") == false) {
                        $this->error = "File upload size  for cover image exceeds the value of " . $this->HRFS($this->MFS);
                    } else {
                        $this->error = "It seems you have tried to upload an unsuppored file format as a cover image";
                    }
                } elseif (($this->meet_id == 0) or ($this->dest_id == 0)) {
                    $this->error = " One or more Address choices is invalid Please make another selection";
                } //                End Verification
                else {
//                    Check thumbnail is empty
                    if ($this->EmptyFIle("thumb") == false) {
//                        Load images and delete the previous one;
                        $thumbs = Image::where("id", $event->thumbnail);
                        if ($thumbs->count() == 1) {
                            $thumb = $thumbs->first();
                            if (file_exists(UPLOAD_DIR . "/" . $thumb->name)) {
                                $this->rmfile($thumb->name);
                            }
//                            Delete from record either way
                            $thumbs->delete();

                        }

//                            Upload new Image
                        if ($this->upload("thumb") == true) {
                            $thumb = new Image();
                            $thumb->user_id = $auth->id();
                            $thumb->entity_name = $this->entity_name;
                            $thumb->entity_id = $event->id;
                            $thumb->imagetype = "thumbnail";
                            $thumb->name = $this->hashed_name;
                            $thumb->type = $this->GetFile("type");
                            $thumb->size = $this->GetFile("size");
                            $thumb->save();
                            $thumbSuccess = true;
                        }
                    }


//                    Check Cover photo

                    if ($this->EmptyFIle("cover") == false) {
//                        Load images and delete the previous one;
                        $covers = Image::where("id", $event->cover);
                        if ($covers->count() == 1) {
                            $cover = $covers->first();
                            if (file_exists(UPLOAD_DIR . "/" . $cover->name)) {
//                                Remove the file;
                                $this->rmfile($cover->name);
                            }
//                            Delete from record either way
                            $covers->delete();
                        }

//                            Upload new Image

                        if ($this->upload("cover") == true) {
                            $cover = new Image();
                            $cover->user_id = $auth->id();
                            $cover->entity_name = $this->entity_name;
                            $cover->entity_id = $event->id;
                            $cover->imagetype = "cover";
                            $cover->name = $this->hashed_name;
                            $cover->type = $this->GetFile("type");
                            $cover->size = $this->GetFile("size");
                            $cover->save();
                            $coversuccess = true;
                        }
                    } else {
                        $cover_id = null;
                    }

//                                End image upload for covers
                }


                if (!$this->error) {
                    $event->title = $this->title;
                    $event->slug = slug($this->title);
                    $thumbSuccess == true ? $event->thumbnail = $thumb->id : $event->thumbnail = false;
                    $coversuccess == true ? $event->cover = $cover->id : false;
                    $event->content = $this->content;
                    $event->start_at = $this->start_date;
                    $event->end_at = $this->end_date;
                    $event->meet_id = $this->meet_id;
                    $event->dest_id = $this->dest_id;
//                    Map url removed in place of Resources
                    $event->save();
                    $this->addurl("http://" . $_SERVER['HTTP_HOST'] . $url->make("events.view", ["slug" => $event->slug]))->newactivity("event", "update", true);

                    redirect($url->make("auth.admin.events.home"));
                } else {
                    $this->error = "Event Update failed";
                }
            } //            Return csrf error
            else {
                $this->error = "Csrf Token Is Invalid";
            }
        } //        Return no event found error
        else {
            $this->error = "event not found";
        }

        if ($this->error) {
            $this->$id = base64_decode($id);
            $this->event = Event::find($this->id);
            echo TemplateEngine::View("Pages.Backend.Events.edit", ["url" => $url, "addresses" => $this->address, "request" => $this]);
        }

    }

    public function delete($id, Url $url, Auth $auth)
    {
        $this->id = base64_decode($id);
        $events = Event::where("id", $this->id);

        if ($events->count() == 1) {
            $event = $events->get()->first();

            //        Delete the thumbnails
            $thumbs = Image::where("id", $event->thumbnail);
            if ($thumbs->count() == 1) {
                $thumb = $thumbs->first();
                if (file_exists(UPLOAD_DIR . "/" . $thumb->name)) {
                    $this->rmfile($thumb->name);
                }
//                            Delete from record either way
                $thumbs->delete();

            }

//        delete Cover images
            $covers = Image::where("id", $event->cover);
            if ($covers->count() == 1) {
                $cover = $covers->first();
                if (file_exists(UPLOAD_DIR . "/" . $cover->name)) {
//                                Remove the file;
                    $this->rmfile($cover->name);
                }
//                            Delete from record either way
                $covers->delete();
            }
//        Delete the Event
            $events->delete();
            redirect($url->make("auth.admin.events.home"));
        }
        echo TemplateEngine::View("Pages.Backend.Events.index", ["events" => $events, "url" => $url, "error" => $this->error]);
    }

}