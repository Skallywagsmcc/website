<?php

use mbamber1986\Authclient\Auth;

$auth = new Auth();
?>


        <!DOCTYPE html>
<html>
<head>
    <title>Skallywags MCC @yield("title")</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/Assets/css/bootstrap.css">
    <link rel="stylesheet" href="/Assets/themes/BBB/backend/base.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="/Resources/js/popper.js"></script>
    <script src="/Resources/js/bootstrap.min.js"></script>
    <script src="/Assets/js/functions.js" type="text/javascript"></script>
    <script src="/Assets/js/Backend/ckeditor.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>
<div class="container-fluid" id="topbar">
    <div class="row">
        <div class="ml-2 mr-auto py-1">
            <a href="#" class=" menu px-3 d-lg-none py-2 mx-1"></a>
            <a href="#" class="d-lg-none closemenu px-3 py-2 mx-1"></a>
            <img src="/img/logo.png" class="my-2" width="50px" height="50px" alt=""> My Account
        </div>

        <div class=" ml-auto mr-2 py-4">
            @if(\App\Http\Models\Profile::where("user_id",$auth->id())->get()->first()->profile_pic == null)
                <img src="/img/logo.png" alt="Logo" class="profile_pic">

            @else
                <img src="/img/uploads/{{\App\Http\Models\User::find($auth->id())->Profile->Image->name}}"
                     alt="{{$image->name}}" class="profile_pic">
            @endif
            <a href="{{$url->make("account.home")}}" class="py-1 px-2">{{ucfirst($auth->getusername())}}</a>
        </div>
    </div>
</div>
<div class="wrap">
    <div id="container" class="container-fluid">
        <div class="row">
            <div class="col-sm-12 px-0 mx-0 col-md-4 col-lg-2 d-none d-lg-block" id="navbar">
                <div class="row my-1 pb-1 mx-0">
                    <div class="col-sm-12 head">Hi {{$auth->getusername()}}</div>
                    <div class="col-sm-12 px-0">
                        <a class="d-block py-2" href="{{$url->make("account.home")}}">Account home</a>
                    </div>
                    @if(User()->is_admin == 1)
                        <div class="col-sm-12 px-0">
                            <a class="d-block py-2" href="{{$url->make("auth.admin.home")}}">Admin Control Panel</a>
                        </div>
                        @endif

                    <div class="col-sm-12 text-center px-0">
                        <a href="{{$url->make("logout")}}" class="d-block py-2">Logout</a>
                    </div>
                </div>

                <div class="row my-1 pb-1 mx-0">
                    <div class="col-sm-12 head">Edit Profile</div>
                    <div class="col-sm-12 px-0">
                        <a class="d-block py-2" href="{{$url->make("account.basic.home")}}">Basic Information</a>
                    </div>

                    <div class="col-sm-12 px-0">
                        <a class="d-block py-2" href="{{$url->make("account.about.home")}}"> About me</a>
                    </div>

                    <div class="col-sm-12 px-0">
                        <a class="d-block py-2" href="{{$url->make("account.picture.home")}}">Update Profile Image</a>
                    </div>
                </div>



                <div class="row my-1 pb-1 mx-0">
                    <div class="col-sm-12 head">Account Security</div>
                    <div class="col-sm-12 px-0">
                        <a class="d-block py-2" href="{{$url->make("security.email.home")}}">Change email Address</a>
                    </div>

                    <div class="col-sm-12 px-0">
                        <a class="d-block py-2" href="{{$url->make("security.password.home")}}">Change Password</a>
                    </div>

                    <div class="col-sm-12 px-0">
                        <a class="d-block py-2" href="#">Update Account Settings(coming soon)</a>
                    </div>

                </div>


                <div class="footer py-2">
                    {{$_ENV["APP_NAME"]}} &copy; {{date("Y")}}
                </div>
            </div>
            <div class="col-sm-12 col-lg-10" id="content">
                @yield("content")
            </div>
        </div>
    </div>
</div>


</body>
</html>


<script>
    $(document).ready(function () {
        $(".closemenu").hide();
        $(".menu").click(function () {
            $(".closemenu").show()
            $("#navbar").removeClass("d-none");
            $(this).hide();
            return false
        })

        $("body").on("click", ".closemenu", function () {
            $(".menu").show();
            $("#navbar").addClass("d-none");
            $(this).hide();
            return false;
        })
    })
</script>