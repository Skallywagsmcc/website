<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Models\Resource;
use App\Http\Models\ResourceCategories;
use MiladRahimi\PhpRouter\Url;

class ResourceController
{

    public $id;
    public $name;
    public $value;
    public $error;

    public function __construct(Validate $validate)
    {
        $this->id = $validate->Post("id");
        $this->name = $validate->Post("name");
        $this->value = $validate->Post("value");
    }


    public function index(Url $url)
    {
        $categories = ResourceCategories::groupBy("name")->get();

        echo TemplateEngine::View("Pages.Backend.AdminCp.Resources.index", ["url" => $url, "categories" => $categories]);
    }


    public function view($resource_id, Url $url)
    {
        $id = base64_decode($resource_id);
        $categories = ResourceCategories::all();
        $category = ResourceCategories::where("id", $id)->get();
        echo TemplateEngine::View("Pages.Backend.AdminCp.Resources.view", ["url" => $url, "category" => $category, "categories" => $categories]);
    }

    public function store($resource_id, Url $url)
    {
        $resource_id = base64_decode($resource_id);
        $resource = new Resource();
        $resource->resource_id = $resource_id;
        $resource->name = $this->name;
        $resource->value = $this->value;
        $resource->save();
        redirect($url->make("auth.admin.resources.view", ["resource_id" => base64_encode($resource_id)]));
    }

    public function edit($id, Url $url, Validate $validate)
    {
        $id = base64_decode($id);
        $resource = Resource::where("id", $id)->get();
        if ($resource->count() == 1) {
            $resource = $resource->first();
        }
        echo TemplateEngine::View("Pages.Backend.AdminCp.Resources.edit", ["url" => $url, "resource" => $resource]);
    }

    public function update(Url $url, Csrf $csrf, Validate $validate)
    {
        if ($csrf->Verify() == true) {

            $validate->AddRequired(["name", "value"]);
            $resource = Resource::where("id", $this->id)->get();
            if($resource->count() ==1)
            {
                $resource = $resource->first();
            }
            if ($validate->Allowed() == false) {
                $this->error = "Required Fields are Missing";
                $required = $validate->is_required;
            } else {
                    $resource = $resource->first();
                    $resource->name = $this->name;
                    $resource->value = $this->value;

                    if ($resource->save()) {
                        redirect($url->make("auth.admin.resources.view", ["resource_id" => base64_encode($resource->id)]));
                    }
            }
        }

        echo TemplateEngine::View("Pages.Backend.AdminCp.Resources.edit", ["url" => $url, "resource" => $resource,"required"=>$required,"error"=>$this->error,"post"=>$this]);

    }


    public function delete($id, Url $url)
    {
        $id = base64_decode($id);
        $resources = Resource::where("id", $id);
        if ($resources->count() == 1) {
            $id = $resources->get()->first()->Category->id;
            $resources->delete();
            redirect($url->make("auth.admin.resources.view", ["resource_id" => base64_encode($id)]));
        } else {
            echo "Page not found";
        }
    }

}