<?php


namespace App\Http\Middleware;


use App\Http\Libraries\Authentication\Auth;
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
            if ($mode->installed == 0) {
                echo "Site Database Needs to be Installed";
            } elseif ($mode->maintainence_status == 0) {
                    $user = User::where("id", $auth::id())->get();
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
                        echo "site is down for maintainence";
                    }


            } else {
                return $next($request);
            }
        } else {
            $settings = new SiteSettings();
            $settings->id = 1;
            $settings->save();
        }

    }
}