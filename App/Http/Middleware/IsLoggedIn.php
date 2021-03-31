<?php


namespace App\Http\Middleware;
use MiladRahimi\PhpRouter\Router;
use MiladRahimi\PhpRouter\Url;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\JsonResponse;
use App\Http\Models\User;
use App\Http\Libraries\Authentication\Auth;
use Closure;

class IsLoggedIn
{
    public function handle(ServerRequestInterface $request, Closure $next, Url $url)
    {
//        we will check for roles here
      $user = User::where("id",Auth::id())->get();
      if($user->count() == 1)
      {

      }
      else
      {
          redirect($url->make("login"));
      }
        return $next($request);

    }
}