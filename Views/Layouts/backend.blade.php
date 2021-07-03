<!DOCTYPE html>
<html>
<head>
    <title>Skallywags MCC @yield("title") </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/Assets/css/bootstrap.css">
    <link rel="stylesheet" href="/Assets/custom/css/backend/backend.css"/>
    <script src="/Resources/js/jquery.js"></script
    <script src="/Resources/js/popper.js"></script>
    <script src="/Resources/js/bootstrap.min.js"></script>
    <script src="/Assets/js/functions.js" type="text/javascript"></script>
</head
<body>
{{--<div class="container-fluid">--}}
{{--    <div class="row">--}}
{{--        <div class="col-sm-12 px-0 mx-0">--}}
{{--            Control Panel--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<nav class="navbar navbar-expand-lg" id="navbar">
    <div class="navbar-brand">
        <img src="/img/logo.png" alt="Logo">
    </div>
    {{--    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"--}}
    {{--            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">--}}
    {{--        Menu--}}
    {{--    </button>--}}
    <a href="#"  class="navbar-toggler d-block d-md-none" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
       aria-expanded="false" aria-label="Toggle navigation">Menu</a>

    <div class="collapse navbar-collapse" id="navbarNav">


        <ul class="ml-auto navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{$url->make("contact-us")}}">Edit Profile</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{$url->make("contact-us")}}">Security and settings</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{$url->make("contact-us")}}">Admin Panel</a>
            </li>
{{--            @include("Includes.Frontend.dropdown")--}}
        </ul>
    </div>

</nav>

@yield("content")

</body>
</html>