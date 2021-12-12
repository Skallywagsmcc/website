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
            <img src="/img/logo.png" class="my-2" width="50px" height="50px" alt=""> Admin Panel
        </div>

        <div class=" ml-auto mr-2 py-4">
            @if(\App\Http\Models\Profile::where("user_id",$auth->id())->get()->first()->profile_pic == null)
                <img src="/img/logo.png" alt="Logo" class="profile_pic">

            @else
                <img src="/img/uploads/{{\App\Http\Models\User::find($auth->id())->Profile->Image->name}}"
                     alt="{{$image->name}}" class="profile_pic">
            @endif
            <a href="{{$url->make("account.home")}}" class="py-1 px-2">{{ucfirst($auth->getusername())}}</a> <a
                    href="{{$url->make("logout")}}" class="py-1 px-2">Logout</a>
        </div>
    </div>
</div>
<div class="wrap">
    <div id="container" class="container-fluid">
        <div class="row">
            <div class="col-sm-12 px-0 mx-0 col-md-4 col-lg-2 d-none d-lg-block" id="navbar">

                <div class="row  my-1 pb-1 mx-0">
                    <div class="col-sm-12 head py-2 pl-lg-1 pl-lg-1">User Managerment</div>
                    <div class="col-sm-12 px-0"><a href="{{$url->make("auth.admin.users.home")}}"
                                                   class="d-block py-2">List Users</a></div>
                    <div class="col-sm-12 px-0">
                        <a href="{{$url->make("auth.admin.users.new")}}"
                           class="d-block py-2 ">Create a new User</a>
                    </div>
{{--                    <div class="col-sm-12 px-0">--}}
{{--                        <a href="#"--}}
{{--                           class="d-block py-2 ">Roles and Permissons</a>--}}
{{--                    </div>--}}
                </div>

                <div class="row  my-1 pb-1 mx-0">
                    <div class="col-sm-12 head py-2 pl-lg-1 pl-lg-1">Article Manager
                </div>
                <div class="col-sm-12 px-0"><a href="{{$url->make("auth.admin.articles.home")}}" class="d-block py-2">List
                        Articles</a></div>
                    <div class="col-sm-12 px-0"><a href="{{$url->make("auth.admin.articles.new")}}" class="d-block py-2">Add New Article</a></div>
            </div>

            <div class="row  my-1 pb-1 mx-0">
                <div class="col-sm-12 head py-2 pl-lg-1">Charter Manager</div>
                <div class="col-sm-12 px-0"><a href="{{$url->make("auth.admin.charters.home")}}" class="d-block py-2">List
                        Charters</a></div>
                <div class="col-sm-12 px-0"><a href="{{$url->make("auth.admin.charters.create")}}" class="d-block py-2">Add New
                        Charter</a></div>
            </div>

            <div class="row  my-1 pb-1 mx-0">
                <div class="col-sm-12 head py-2 pl-lg-1">Events Manager</div>
                <div class="col-sm-12 px-0"><a href="{{$url->make("auth.admin.events.home")}}" class="d-block py-2">List
                        Events
                        Events</a></div>
            </div>

            <div class="row  my-1 pb-1 mx-0">
                <div class="col-sm-12 head py-2 pl-lg-1">Image Manager</div>
                <div class="col-sm-12 px-0"><a href="{{$url->make("auth.admin.images.home")}}"
                                               class="d-block py-2">List Images Uploads</a></div>
                <div class="col-sm-12 px-0"><a href="{{$url->make("auth.admin.featured.home")}}" class="d-block py-2">
                        Featured Image Request</a></div>
            </div>

            <div class="row  my-1 pb-1 mx-0">
                <div class="col-sm-12 head py-2 pl-lg-1">Other Management Tools</div>
                <div class="col-sm-12 px-0"><a href="{{$url->make("auth.admin.settings.home")}}" class="d-block py-2">Update
                        Site Settings</a></div>
                <div class="col-sm-12 px-0"><a href="{{$url->make("auth.admin.resources.home")}}" class="d-block py-2">Manage External Resources</a></div>
            </div>
        </div>
        <div class="col-sm-12  col-md-8 col-lg-10" id="content">
            @yield("content")
        </div>
    </div>
</div>
</div>
<div class="footer py-2">
    The footer goes here
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