<div class="container">
    @if(\App\Http\Libraries\Authentication\Auth::id() == $user->id)
        <div class="row">
            <div class="col-sm-12 px-0 pr-2 text-right pr-md-5"><h5><a href="#">Edit Profile</a></h5></div>
        </div>

    @endif
    <div class="row mt-3 ">
        <div class="col-sm-12 d-flex justify-content-center px-0">
            <img src="/img/uploads/{{$user->Profile->Image->image_name}}" class="profile_pic m-2" height="150" width="150" alt=" {{$user->username}} Profile Image">
        </div>
        <div class="col-sm-12 text-center px-0">
            <h3>{{$user->username}}</h3>
        </div>
    </div>
    <div class="row event text-center px-0">
        <div class="col-sm-12 d-block d-md-none"><h2>Profile Menu</h2></div>
        <div class="col-sm-12 col-md-4 py-2"><a href="{{$url->make("profile.view",["username"=>$user->username])}}">About</a></div>
        <div class="col-sm-12 col-md-4 py-2"><a href="{{$url->make("profile.gallery.home",["username"=>$user->username])}}">Gallery</a></div>
    </div>
</div>

