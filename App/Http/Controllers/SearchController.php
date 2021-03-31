<?php


namespace App\Http\Controllers;


use App\Http\Functions\BladeEngine;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Libraries\Pagination\LaravelPaginator;
use App\Http\Models\Page;
use App\Http\Models\User;
use Laminas\Diactoros\ServerRequest;
use MiladRahimi\PhpRouter\Url;

class SearchController
{


    public function index(Url $url)
    {
        echo BladeEngine::View("Pages.Frontend.Search.index",["url"=>$url]);
    }

    public function view(Url $url, ServerRequest $request)
    {
        $keyword = $request->getQueryParams()['keyword'];
        $pages = Page::whereRaw('MATCH (title, content) AGAINST (?)' , array($keyword));
        $count = $pages->count();
        $page = new LaravelPaginator("1","p");
        $result = $page->paginate($pages);
//        Needs to be after paginate
        $links = $page->page_links('?','&keyword='.$keyword);

        $user = User::all();
        echo BladeEngine::View("Pages.Frontend.Search.view",["url"=>$url,"count"=>$count,"user"=>$user,"pages"=>$result,"links"=>$links]);


    }


}