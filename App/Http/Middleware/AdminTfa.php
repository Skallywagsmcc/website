<?php

namespace App\Http\Middleware;

use App\Http\Libraries\Authentication\Auth;
use App\Http\Models\User;
use MiladRahimi\PhpRouter\Url;
use Psr\Http\Message\ServerRequestInterface;
use Closure;

class AdminTfa
{
    public function handle(ServerRequestInterface $request, Closure $next, Url $url)
    {
        /*Ths middleware will do a check to see if TwoFactorAuthentication is enabled  and if it is required

        We are going to check the following

        1 : check for users and user settings and check if tfa is  enabled

        2 : if two factor authentication  is enabled do a check to see if tfa_approved  exists with an expire session with a time of 15 mins
        3 : the user is then required to put the requested code in the input field and if the code matches set tfa_approved = 1 and destroy the expire session
        4 redirect to user profile (this may change to the last visited page before redirect();


        if it isnt enbled simply redirect to the page.
        */

//        step 1 check user settings with logged in user

//        $user = User::find(Auth::id());
//        if (($user->is_admin == 1)) {
//            if(isset($_SESSION['tfa_approved']) && (($_SESSION['tfa_approved']) == 0))
//            {
//                redirect($url->make("tfa.index"));
//            }
//            else
//            {
//                return $next($request);
//            }
//        }
//        else
//        {
//            return $next($request);
//        }
        return $next($request);


    }
}