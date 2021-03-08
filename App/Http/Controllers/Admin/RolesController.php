<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\BladeEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Authenticate;
use App\Http\Models\Role;

class RolesController
{

    public function index()
    {
        $roles = Role::all();

        echo BladeEngine::View("Pages.Admin.Roles.index", ["roles" => $roles, "count" => $roles->count()]);
    }

    public function create()
    {
        $validate = new Validate();
        $role = new Role();
        $role->title = $validate->Required("title")->Post();
        $role->slug = slug($role->title);
        echo BladeEngine::View("Pages.Admin.Roles.new", ["roles" => $roles]);


    }

    public function store()
    {
        $validate = new Validate();
        $role = new Role();
        $role->title = $validate->Required("title")->Post();
        $role->slug = slug($role->title);

        if ($validate->data == false) {
            Authenticate::$errmessage = "some fields are missing";
        } else
        {
            $role->save();
            redirect("/admin/roles");
        }
        echo BladeEngine::View("Pages.Admin.Roles.new" , ["role" => $role,"message"=>Authenticate::$errmessage]);
    }


    public function edit($id)
    {
        $results = Role::where("id", $id)->get();
        $count = $results->count();
        $role = $results->first();

        echo BladeEngine::View("Pages.Admin.Roles.edit" , ["role" => $role,"message"=>Authenticate::$errmessage]);

    }

    public function update()
    {
        $validate = new Validate();
        $role = Role::find($validate->Post("id"));
        $role->title = $validate->Required("title")->Post();
        $role->slug = slug($role->title);
        $role->save();
        redirect("/admin/roles");
    }

    public function delete($id)
    {
        $role = Role::find($id)->delete();
        redirect("/admin/roles");
    }


}