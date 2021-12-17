<?php
use App\Http\Controllers\SystemController;
$system = new SystemController();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Skallywags MCC @yield("title") </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/Assets/css/bootstrap.css">
    <link rel="stylesheet" href="/Assets/css/custom/base.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="/Resources/js/popper.js"></script>
    <script src="/Resources/js/bootstrap.min.js"></script>
    <script src="/Assets/js/functions.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6LcklagdAAAAAAb7fXVtUQAdaJMPWk68K_pqztt4"></script>

    @yield("head")
</head>
<body>
@include("Includes.Frontend.Navbar")

<div id="app" class="container-wrapper px-0">

    <div class="container-fluid m-0 p-0">
        <div class=" d-none d-md-block logo_wrapper pb-3 pt-3 text-center">
            <img src="/img/logo.png" alt="Logo">
        </div>
        <div class=" container-fluid breadcrumbs my-2">
            {!!breadcrumbs(' > ')!!}
        </div>
        @yield("content")

    </div>
</div>


<div class="row py-3 mx-0 footer">
    <div class="col-sm-12 col-md-4 text-center text-md-left">

        {{$_SERVER['APP_NAME']}} {{date("Y")}}  &copy; : {{$system->readini("System","Version")}} | <a href="{!!$system->readini("System","Repo")!!}">{{$system->readini("System","Repo_title")}}</a>

        @foreach($system->parsefile(true,"Updates") as $key => $value)
            {{$key}}
            {{$value["Whats new"]}}
            <br>
            {{str_replace("\n\n","<br>",$value["Content"])}}
        {{$value["Date"]}}
            <br>
        @endforeach
    </div>
    <div class="col-sm-12 col-md-8 text-center px-0">
        <a href="{{$url->make("resources.home")}}">Useful Links</a>
    </div>
</div>

</body>
</html>