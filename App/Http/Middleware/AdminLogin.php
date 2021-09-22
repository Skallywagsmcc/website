<?php


namespace App\Http\Middleware;
use App\Http\Libraries\Authentication\Auth;
use App\Http\Models\User;
use MiladRahimi\PhpRouter\Router;
use MiladRahimi\PhpRouter\Url;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Closure;

class AdminLogin
{
    public function handle(ServerRequestInterface $request, Closure $next, Url $url)
    {

//        we will check for roles here
        $admin = User::where("id",Auth::id())->where("is_admin",1)->get();
        if($admin->count()==1) {
            return $next($request);
        }
        else
        {
            redirect($url->make("homepage")."?error=restricted");
        }
//
    }
}