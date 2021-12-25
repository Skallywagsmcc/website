<?php

require __DIR__.'/../System/includes/AuthFunctions.php';
use mbamber1986\Authclient\Auth;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Models\Event;
use App\Http\Models\User;

function slug($slug)
{
    return str_replace(" ", "-", $slug);
}


function redirect($location)
{
    return header('location:' . $location . '');
}


function Auth()
{

    return Auth::Loggedin() == true;
}

function LastLogin()
{
    $auth = new Auth();
    $user = User::find($auth->id());
    return date("H:i", strtotime($user->updated_at)) . "  " . date("d/m/Y", strtotime($user->updated_at));
}


function csrf()
{
    return Csrf::Key();
}

function baseclass($value)
{
    return $reflection = new ReflectionClass($value);
}


function ClearBladeCache()
{
    $path = __DIR__ . '/../Storage/Cache/*';
    array_map('unlink', array_filter((array)glob($path)));
}

function events()
{
    return Event::all()->take(5);
}

function breadcrumbs($separator = ' &raquo; ', $home = 'Home')
{
    // This gets the REQUEST_URI (/path/to/file.php), splits the string (using '/') into an array, and then filters out any empty values
    $path = array_filter(explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));

    // This will build our "base URL" ... Also accounts for HTTPS :)

    if (isset($_SERVER["HTTPS"])) {
        $base = 'https://' . $_SERVER['HTTP_HOST'] . '/';
    } else {
        $base = 'http://' . $_SERVER['HTTP_HOST'] . '/';
    }


    // Initialize a temporary array with our breadcrumbs. (starting with our home page, which I'm assuming will be the base URL)
    $breadcrumbs = array("<a href=\"$base\">$home</a>");

    // Initialize crumbs to track path for proper link
    $crumbs = '';

    // Find out the index for the last value in our path array
    $last = end(array_keys($path));

    // Build the rest of the breadcrumbs
    foreach ($path as $x => $crumb) {
        // Our "title" is the text that will be displayed (strip out .php and turn '_' into a space)
        $title = ucwords(str_replace(array('.php', '_', '%20'), array('', ' ', ' '), $crumb));

        // If we are not on the last index, then display an <a> tag
        if ($x != $last) {
            $breadcrumbs[] = "<a href=\"$base$crumbs$crumb\">" . str_replace("-", " ", $title) . "</a>";
            $crumbs .= $crumb . '/';
        } // Otherwise, just display the title (minus)
        else {
            $breadcrumbs[] = str_replace("-", " ", $title);
        }

    }

    // Build our temporary array (pieces of bread) into one big string :)
    return implode($separator, $breadcrumbs);
}

