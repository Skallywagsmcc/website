<?php


namespace App\Http\Middleware;


use App\Http\Functions\TemplateEngine;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Models\SiteSettings;
use App\Http\Models\User;
use Illuminate\Database\Capsule\Manager as Capsule;
use MiladRahimi\PhpRouter\Url;
use Psr\Http\Message\ServerRequestInterface;
use Closure;

class Installer
{
    public function handle(ServerRequestInterface $request, Closure $next, Url $url, Auth $auth)
    {
        if(Capsule::schema()->hasTable("Site_settings"))
        {
            $settings = SiteSettings::where("id",1)->where("installed",1)->get();
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