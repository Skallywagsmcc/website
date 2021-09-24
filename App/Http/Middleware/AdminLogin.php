<?php


namespace App\Http\Middleware;
use mbamber1986\Authclient\Auth;
use App\Http\Models\User;
use MiladRahimi\PhpRouter\Router;
use MiladRahimi\PhpRouter\Url;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Closure;

class AdminLogin
{
    public function handle(ServerRequestInterface $request, Closure $next, Url $ur,Auth $auth)
    {

//        we will check for roles here
        $admin = User::where("id",$auth->id())->where("is_admin",1)->get();
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