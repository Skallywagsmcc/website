<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Models\Profile;
use App\Http\Models\Resource;
use App\Http\Models\ResourceCategories;
use MiladRahimi\PhpRouter\Url;


class ResourceCategoriesController
{

    public $id;
    public $name;

    public function __construct(Validate $validate)
    {
        $this->id = $validate->Post("id");
        $this->name = $validate->Post("name");
    }

    public function index(Url $url)
    {
        $categories = ResourceCategories::all();

        echo TemplateEngine::View("Pages.Backend.AdminCp.Resources.category.home", ["url" => $url, "categories" => $categories]);
    }

    public function store(Csrf $csrf, Url $url, Validate $validate)
    {
        if ($csrf->Verify() == true) {
            $validate->AddRequired(["name"]);
            $categories = ResourceCategories::all();
            if ($validate->Allowed() == false) {
                $error = "Required fields are missings";
                $required = $validate->is_required;
            }
            $category = new ResourceCategories();
            $category->name = $this->name;
            $category->slug = slug($this->name);
            if ($category->save()) {
                redirect($url->make("auth.admin.resources.home"));
            }
            echo TemplateEngine::View("Pages.Backend.AdminCp.Resources.category.home", ["url" => $url, "categories" => $catagory, "error" => $error, "required" => $required]);
        }
    }


    public function edit($id, Url $url)
    {
        $id = base64_decode($id);
        $category = ResourceCategories::where("id", $id)->get();

        if ($category->count() == 0) {
            $error = "The page or result you are looking for cannot be found";
        }
        echo $category->first()->name;
        echo TemplateEngine::View("Pages.Backend.AdminCp.Resources.editCategory", ["url" => $url, "category" => $category->first()]);
    }

    public function update( Csrf $csrf, Url $url, Validate $validate)
    {

        if ($csrf->Verify() == true) {
            $category = ResourceCategories::where("id", $this->id)->get();
            if ($category->count() == 1) {
                $category = $category->first();
                $category->name = $this->name;
                $category->slug = slug($this->name);
                if ($category->save()) {
                    redirect($url->make("auth.admin.resources.home"));
                }
            }
        }
    }

    public function delete($id,Url $url)
    {
        $id = base64_decode($id);
        $category = ResourceCategories::where("id", $id);
        if($category->count() == 1)
        {
            foreach ($category->get()->first()->Resources() as $resource)
            {
               Resource::destroy($resource->id);
            }
            $category->delete();
        }
        redirect($url->make("auth.admin.resources.home"));
    }

}