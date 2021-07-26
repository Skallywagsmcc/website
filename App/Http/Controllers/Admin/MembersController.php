<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Libraries\Pagination\LaravelPaginator;
use App\Http\Models\Member;
use App\Http\Models\User;
use MiladRahimi\PhpRouter\Url;

class MembersController
{

    public function index(Url $url)
    {
//        Find results
        $members = Member::all();
        $users = User::orderBy("id","Asc");
        $paginate = new LaravelPaginator("10","page");
        $users = $paginate->paginate($users);
        $links = $paginate->page_links();

        echo TemplateEngine::View("Pages.Backend.AdminCp.Members.index",["url"=>$url,"members"=>$members,"links"=>$links,"users"=>$users]);

    }


    public function store(Url $url, Csrf $csrf, Validate $validate)
    {
        for($i=0;$i< count($validate->Post("id")); $i++)
        {
            echo $validate->Post("id")[$i] . "<br>";
        }
//        echo TemplateEngine::View("Pages.Backend.AdminCp.Members.index",["url"=>$url,"members"=>$members,"links"=>$links,"users"=>$users]);
    }

    public function manage(Url $url, Validate $validate)
    {

    }

    public function search()
    {

    }

    public function delete($id)
    {

    }


}