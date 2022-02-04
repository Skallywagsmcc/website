<?php

namespace Plugins\Managers;

use App\Http\Functions\Validate;
use App\Http\Models\Resources;
use App\Http\traits\Activity_log;
use MiladRahimi\PhpRouter\Url;

class ResourceManager
{

    use Activity_log;

    public $name;
    public $type;
    public $value;
    public $resource;
    public $status;


    /*
     *
     * pages/contact
     * addresses/general
     * */


    public function __construct(Validate $validate)
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->name = $validate->Post("name");
            $this->type = $validate->Post("type");
            $this->value = $validate->Post("value");
        }
    }

    public function push(Url $url, $entity_name)
    {
        switch ($entity_name) {
            case "page/contact";
                redirect($url->make("auth.admin.contact.home"));
                break;
                case "address/general";
                    redirect($url->make("auth.admin.addresses.home"));
                break;
            default;
                break;
        }
    }


    public function new($entity_name)
    {
        $this->resource = new Resources();
        $this->resource->entity_name = $entity_name;
        $this->resource->name = $this->name;
        $this->resource->type = $this->type;
        $this->resource->value = $this->value;
        if ($this->resource->save()) {
            $this->status = true;
            $this->addurl("http://".$_SERVER['HTTP_HOST'].$url->make("auth.admin.contact.resources.home"))->newactivity("resource","create",true);
        } else {
            $this->status = false;
        }

    }

    public function edit($id, $entity_name)
    {

        $this->resource = Resources::where("id", $id)->get();
        if ($this->resource->count() == 1) {
            $this->resource = $this->resource->first();
            $this->resource->entity_name = $entity_name;
            $this->resource->name = $this->name;
            $this->resource->type = $this->type;
            $this->resource->value = $this->value;
            if ($this->resource->save()) {
               return true;
                $this->addurl("http://".$_SERVER['HTTP_HOST'].$url->make("auth.admin.contact.resources.home"))->newactivity("resource","update",true);
            } else {
                return false;
            }
        } else {
            $this->error = "Page not found";
        }

    }

    public function override()
    {

    }

    public function delete($id)
    {

        $this->resource = Resources::where("id", $id);
        if ($this->resource->count() == 1) {
            $this->resource->delete();
            $this->status = true;
            $this->newactivity("resource","delete",true);
        } else {
            $this->status = false;
        }
    }


}