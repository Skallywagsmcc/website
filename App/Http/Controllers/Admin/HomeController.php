<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Pagination\LaravelPaginator;
use App\Http\Models\Article;
use App\Http\Models\Charter;
use App\Http\Models\Comment;
use App\Http\Models\Event;
use App\Http\Models\FeaturedImage;
use App\Http\Models\Image;
use App\Http\Models\User;
use App\Http\traits\Activity_log;
use MiladRahimi\PhpRouter\Url;

class HomeController
{

    use Activity_log;
    public $activity;
    public $links;
    public function index(Url $url, Validate $validate)
    {
        $pagination = new LaravelPaginator("15","page");
        $this->activity = $this->AdminActivity();
        $this->activity = $pagination->paginate($this->activity);
        $this->links = $pagination->page_links();
        echo TemplateEngine::View("Pages.Backend.AdminCp.index",["url"=>$url,"request"=>$this]);
    }
}