<?php


namespace App\Http\Controllers;


use App\Http\Functions\TemplateEngine;
use App\Http\Models\Resource;
use App\Http\Models\ResourceCategories;
use MiladRahimi\PhpRouter\Url;
use function Symfony\Component\Translation\t;

class ResourceController
{

    public $categories;
    public $resources;

    public function ValidateVar($text,$value)
    {
        return filter_var($text,$value);
    }

    public function index(Url $url)
    {
        $this->resources = ResourceCategories::all();
        echo TemplateEngine::View("Pages.Frontend.Resources.index",["url"=>$url,"value"=>$this]);

    }

    public function view(Url $url,$slug)
    {
        $this->categories = ResourceCategories::where("slug",$slug)->get();
        if($this->categories->count() == 1)
        {
            echo $this->categories->first()->slug;
            foreach ($this->categories->first()->Resources() as $resource) {
                echo $resource->name . "<br>";
            }
        }
        else
        {
            echo "no category found";
        }
    }

}