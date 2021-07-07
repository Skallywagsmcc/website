<!DOCTYPE html>
<html>
<head>
    <title>Skallywags MCC @yield("title") </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/Assets/css/bootstrap.css">
    <link rel="stylesheet" href="/Assets/custom/css/backend/backend.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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

<div class="container-fluid">
    <div class="row py-1 pr-2">
        <div class="col-sm-12 text-right px-0">
            Welcome back {{$user->Profile->first_name}}
        </div>
    </div>
</div>


<nav class="navbar navbar-expand-lg" id="navbar">
    <div class="navbar-brand">
        <img src="/img/logo.png" alt="Logo">
    </div>
    <a href="#"  class="navbar-toggler d-block d-md-none" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
       aria-expanded="false" aria-label="Toggle navigation">Menu</a>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="ml-auto navbar-nav">

            <li class="nav-item">
                <a href="#" class="nav-link">Account Manager</a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">Image Manager</a>
            </li>

            @if($user->is_admin == 1)
            <li class="nav-item">
                <a href="#" class="nav-link">Admin Manager</a>
            </li>
@endif
            <li class="nav-item">
                <a href="#" class="nav-link">Site Settings</a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">Logout</a>
            </li>

        </ul>
    </div>

</nav>
<div id="content-wrapper" class="p-0">
    @yield("content")
</div>

<div class="row footer mx-0">
    <div class="col-sm-12">Footer goes here</div>
</div>
</body>
</html>