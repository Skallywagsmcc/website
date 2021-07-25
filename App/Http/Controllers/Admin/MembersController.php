<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\TemplateEngine;
use App\Http\Libraries\Pagination\LaravelPaginator;
use App\Http\Models\Member;
use MiladRahimi\PhpRouter\Url;

class MembersController
{

    public function index(Url $url)
    {
//        Find results
        $members = Member::orderBy("id","Asc");
        $paginate = new LaravelPaginator("10","page");
        $members = $paginate->paginate($members);
        $links = $paginate->page_links();

        echo TemplateEngine::View("Pages.Backend.AdminCp.Members.index",["url"=>$url,"members"=>$members,"links"=>$links]);

    }

}