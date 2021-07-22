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

{{--    <div class="row" id="welcome">--}}
{{--        <div class="col-sm-12 py-3 pr-2 text-right">--}}
{{--            Welcome back {{$user->Profile->first_name}}--}}
{{--        </div>--}}
{{--    </div>--}}



@include("Includes.Backend.Nav")

<div class="container-fluid text-center text-md-left my-3 py-2" id="account_bar">
    <img src="/img/uploads/{{\App\Http\Models\User::find(\App\Http\Libraries\Authentication\Auth::id())->Profile->Image->name}}" alt="{{$image->name1}}" class="profile_pic">
    {{\App\Http\Libraries\Authentication\Auth::getusername()}} : Last Login was : {{LastLogin()}}
</div>
<div id="content-wrapper" class="p-0">
    @yield("content")
</div>

<div class="row footer mx-0">
    <div class="col-sm-12">UCP {{date("Y")}} by Martin </div>
</div>
</body>
</html>