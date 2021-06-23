<!DOCTYPE html>
<html>
<head>
    <title>Skallywags MCC @yield("title") </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/Assets/css/bootstrap.css">
    <link rel="stylesheet" href="/Assets/custom/css/backend/backend.css"/>
    <script src="/Resources/js/jquery.js"></script>
    <script src="/Resources/js/popper.js"></script>
    <script src="/Resources/js/bootstrap.min.js"></script>
    <script src="/Assets/js/functions.js" type="text/javascript"></script>
</head
<body>
@include("Includes.Backend.Navbar")
<div class="container-wrapper">

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-2 d-none d-md-block sidebar vh-100 text-center">
                Welcome
            </div>
            <div class="col-sm 12 col-md-10">
                        @yield("content")
            </div>
        </div>
    </div>


</div>
<div class="footer">
    <div class="row py-2">
        <div class="col-sm-12 col-md-4 text-center text-md-left">
            {{$_SERVER['APP_NAME']}} {{date("Y")}}  &copy; : {{$_SERVER['VERSION']}}
        </div>
    </div>
</div>
</body>
</html>