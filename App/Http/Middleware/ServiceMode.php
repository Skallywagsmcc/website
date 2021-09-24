<?php


namespace App\Http\Middleware;


use App\Http\Functions\TemplateEngine;
use mbamber1986\Authclient\Auth;
use App\Http\Models\SiteSettings;
use App\Http\Models\User;
use MiladRahimi\PhpRouter\Url;
use Psr\Http\Message\ServerRequestInterface;
use Closure;

class ServiceMode
{
    public function handle(ServerRequestInterface $request, Closure $next, Url $url, Auth $auth)
    {


        $mode = SiteSettings::where("id", 1)->get();
        if (($mode->count() == 1)) {
            $mode = $mode->first();
//            complete Database Install
         if ($mode->maintainence_status == 0) {
                    $user = User::where("id", $auth->id())->get();
                    if($user->count() == 1)
                    {
                        if($user->first()->is_admin == 1)
                        {
                            echo "<h2 class='lb1 text-center'>Hello ".$user->first()->Profile->first_name." You are currently viewing the site in maintainence Mode</h2>";
                            return $next($request);
                        }
                        else
                        {
                            redirect($url->make("logout"));
                        }
                    }
                    else
                    {
                        echo "<h2 class='lb3 text-center'>Site is Down For Maintainence Login Is Accessable</h2>";
                        echo TemplateEngine::View("Pages.Frontend.Maintainence.index",["url"=>$url]);
                    }


            } else {
                return $next($request);
            }
        } else {

        }

    }
}