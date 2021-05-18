<?php


namespace App\Http\Controllers;


use App\Http\Functions\TemplateEngine;
use App\Http\Libraries\Pagination\LaravelPaginator;
use App\Http\Models\Member;
use MiladRahimi\PhpRouter\Url;

class Members
{
    public function index(Url $url)
    {
        $members = Member::orderBy("id","asc");
        $paginator = new LaravelPaginator("10","p");
        $members = $paginator->paginate($members);
        $links = $paginator->page_links();
        echo TemplateEngine::View("Pages.Frontend.Members.index",["url"=>$url,"links"=>$links,"members"=>$members]);
    }

}