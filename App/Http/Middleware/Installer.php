<?php


namespace App\Http\Middleware;



use App\Http\Libraries\Authentication\Auth;
use Illuminate\Database\Capsule\Manager as Capsule;
use MiladRahimi\PhpRouter\Url;
use Psr\Http\Message\ServerRequestInterface;
use Closure;

class Installer
{
    public function handle(ServerRequestInterface $request, Closure $next, Url $url, Auth $auth)
    {
        if(Capsule::schema()->hasTable("installers"))
        {
            $settings = \App\Http\Models\Installer::where("id",1)->where("status",2)->get();
            if($settings->count() == 1)
            {
                return $next($request);
            }
            else
            {
                redirect("/install");
            }
        }
        else
        {
            redirect("/install");
        }
    }
}