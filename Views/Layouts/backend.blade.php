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
<nav class="navbar navbar-expand-lg" id="navbar">
    <div class="navbar-brand">
        <img src="/img/logo.png"  height="75px" width="75px" alt="Logo">
        <div class="d-inline-block"> : Control Panel</div>
    </div>

    <a href="#"  class="navbar-toggler d-block d-md-none" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
       aria-expanded="false" aria-label="Toggle navigation">Menu</a>

    <div class="collapse navbar-collapse" id="navbarNav">

        <ul class="ml-auto navbar-nav">
            {{--            Predefined--}}
            <li class="nav-item active">
                <a class="nav-link" href="{{$url->make("homepage")}}">Main Site</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{$url->make("charters.home")}}">Edit Details</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{$url->make("articles.home")}}">Security and settings</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{$url->make("articles.home")}}">Admin panel</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{$url->make("events.home")}}">Logout</a>
            </li>
        </ul>

    </div>

</nav>

{{--<div class="container-fluid m-0 p-0">--}}
{{--    <div class="row p-0 m-0">--}}
{{--        <div class="col-sm-12 col-md-2 p-0 m-0 ">--}}
{{--            <div id="sidebar">--}}
{{--                <div class="col-sm-12 img-fluid d-flex justify-content-center">--}}
{{--                    <img src="/img/logo.png" class="img-fluid my-2 p-2" height="100" width="100" alt="Logo">--}}
{{--                </div>--}}
{{--                <div class="col-sm-12 text-center"><h5>User Control Panel</h5></div>--}}
{{--                <hr>--}}
{{--                <div id="navbar">--}}
{{--                    <div class="nav-menu">--}}
{{--                        <div class="nav-toggle py-2"><a href="#">Update my Details</a></div>--}}
{{--                        <ul class="nav flex-column">--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link active" href="#">The Basics</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="#">Update About me</a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div id="navbar">--}}
{{--                    <div class="nav-menu">--}}
{{--                        <div class="nav-toggle py-2"><a href="#">Image Management</a></div>--}}
{{--                        <ul class="nav flex-column">--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link active" href="#">Update Profile Picture</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="#">Manage Gallery</a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div id="navbar">--}}
{{--                    <div class="nav-menu">--}}
{{--                        <div class="nav-toggle py-2"><a href="#">Security And Settings</a></div>--}}
{{--                        <ul class="nav flex-column">--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link active" href="#">Update email Address</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="#">Update Password</a>--}}
{{--                            </li>--}}

{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="#">Account Settings</a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="col-sm-12 col-md-10">--}}
{{--                    @yield("content")--}}
{{--    </div>--}}
{{--</div>--}}
{{--    <div class="col-sm-12 p-0 m-0">--}}
{{--        <div class="footer">--}}
{{--            {{$_SERVER['APP_NAME']}} : {{$_SERVER['VERSION']}}--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
</body>
</html>