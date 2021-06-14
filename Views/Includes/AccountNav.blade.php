<div class="row">
    <div class="col-sm-12 head">
        Menu
    </div>
    <div class="col-sm-12"><a href="{{$url->make("account.home")}}">Account Home</a></div>
    <!--includes firstname  lastname and date of birth-->
    <div class="col-sm-12"><a href="{{$url->make("account.basic.home")}}">Edit Basic Information</a></div>
    <div class="col-sm-12"><a href="{{$url->make("account.about.home")}}"">Edit About me</a></div>
    <hr>
    <div class="col-sm-12"><a href="{{$url->make("account.picture.home")}}">Change Profile Picture</a> </div>
    <div class="col-sm-12"><a href="{{$url->make("account.email.home")}}">Change Email Address</a></div>
    <div class="col-sm-12"><a href="{{$url->make("account.password.home")}}">Change Password</a></div>
    <hr>
{{--    <div class="col-sm-12">My images</div>--}}
{{--    <div class="col-sm-12">My Comments</div>--}}
    <hr>
    <div class="col-sm-12"><a href="{{$url->make("account.settings.home")}}">User Settings</a></div>
</div>


