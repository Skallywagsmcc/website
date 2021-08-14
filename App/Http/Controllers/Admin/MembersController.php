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
        $paginate = new LaravelPaginator("4","page");
        $users = $paginate->paginate($users);
        $links = $paginate->page_links();

        echo TemplateEngine::View("Pages.Backend.AdminCp.Members.index",["url"=>$url,"members"=>$members,"links"=>$links,"users"=>$users]);

    }


    public function add($id,Url $url)
    {
        if(Member::where("user_id",$id)->count() == 0)
        {
            $member = new Member();
            $member->user_id = $id;
            $member->save();
            redirect($url->make("auth.admin.members.home"));
        }
        else
        {
            echo "Already added to member list <a href='".$url->make("auth.admin.members.home")."'>Go Back</a>";
        }


    }

    public function remove($id,Url $url)
    {
        if(Member::where("id",$id)->count() == 1)
        {
        $members = Member::where("id",$id)->delete();
        redirect($url->make("auth.admin.members.home"));
        }
        else
        {
            echo "Already Removed from member list <a href='".$url->make("auth.admin.members.home")."'>Go Back</a>";
        }

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