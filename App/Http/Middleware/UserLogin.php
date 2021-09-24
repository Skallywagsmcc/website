<?php


namespace App\Http\Middleware;
use MiladRahimi\PhpRouter\Router;
use MiladRahimi\PhpRouter\Url;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\JsonResponse;
use App\Http\Models\User;
use mbamber1986\Authclient\Auth;
use Closure;

class UserLogin
{
    public function handle(ServerRequestInterface $request, Closure $next, Url $url,Auth $auth)
    {
//        we will check for roles here
      $user = User::where("id",$auth->id())->get();
      if($user->count() == 0)
      {
          echo "Not logged in";
          redirect($url->make("login"));
      }
      else
      {
          echo "login";
          return $next($request);
      }


    }
}