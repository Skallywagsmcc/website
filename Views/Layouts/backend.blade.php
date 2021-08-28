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
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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

<div  class="container-fluid text-center text-md-left my-3 py-2" id="account_bar">

    <div class="row">
        <div class="col-sm-12 col-md-6">
            @if(\App\Http\Models\Profile::where("user_id",\App\Http\Libraries\Authentication\Auth::id())->get()->first()->profile_pic == null)
                <img src="/img/logo.png" alt="Logo" class="profile_pic">
                {{\App\Http\Libraries\Authentication\Auth::getusername()}}
            @else
                <img src="/img/uploads/{{\App\Http\Models\User::find(\App\Http\Libraries\Authentication\Auth::id())->Profile->Image->name}}" alt="{{$image->name}}" class="profile_pic">
                {{\App\Http\Libraries\Authentication\Auth::getusername()}}
            @endif
        </div>
        <div class="col-sm-12 col-md-6">Your Last Login was : {{LastLogin()}}</div>
    </div>
</div>
<div id="content-wrapper" class="p-0">
    @yield("content")
</div>

<div class="row footer mx-0">
    <div class="col-sm-12">UCP {{date("Y")}} by Martin </div>
</div>


</body>
</html>