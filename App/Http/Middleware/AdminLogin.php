<?php


namespace App\Http\Middleware;
use App\Http\traits\Authentication;
use mbamber1986\Authclient\Auth;
use App\Http\Models\User;
use MiladRahimi\PhpRouter\Router;
use MiladRahimi\PhpRouter\Url;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Closure;

class AdminLogin
{
    use Authentication;
    public function handle(ServerRequestInterface $request, Closure $next, Url $url,Auth $auth)
    {


//        we will check for roles here
        if($this->isAdmin() == true){
            return $next($request);
        }
        else
        {
            redirect($url->make("login")."/?ref=".$_SERVER["REQUEST_URI"]."&access=restricted");
        }
//
    }
}