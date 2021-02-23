<?php


namespace App\Http\Middleware;
use MiladRahimi\PhpRouter\Router;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Closure;

class AdminAuthMiddleware
{
    public function handle(ServerRequestInterface $request, Closure $next)
    {
//        we will check for roles here

        if (!isset($_SESSION['id']) || !isset($_COOKIE['id']))
        {
            header("location:/auth/login");
        }
        return $next($request);

    }
}