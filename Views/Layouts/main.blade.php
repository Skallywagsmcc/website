<!DOCTYPE html>
<html>
<head>
    <title>Skallywags MCC @yield("title") </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/Assets/css/bootstrap.css">
    <link rel="stylesheet" href="/Assets/css/custom/base.css">
    <script src="/Resources/js/jquery.js"></script>
    <script src="/Resources/js/popper.js"></script>
    <script src="/Resources/js/bootstrap.min.js"></script>
    <script src="/Assets/js/functions.js" type="text/javascript"></script>
{{--    toggle--}}

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
</head>
<body>
<div class="container-wrapper">
    @include("Includes.Frontend.Navbar")
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


<div class="footer">
    <div class="row py-3">
        <div class="col-sm-12 col-md-4 text-center text-md-left">
            {{$_SERVER['APP_NAME']}} {{date("Y")}}  &copy; :  {{$_SERVER['VERSION']}}
        </div>
        <div class="col-sm-12 col-md-8 text-center">
            Social Media  Links will go here
        </div>
    </div>
</div>
</body>
</html>