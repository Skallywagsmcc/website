<div class="container my-2">
    <div class="row mx-1 mx-md-0">
        <div class="col-sm-12 px-0" id="cover_base">

            <div class=" col-sm-12 px-0" id="cover_image">
                <img src="/img/uploads/{{$user->Profile->Cover->name}}" alt=" {{$user->username}} Profile Image">
            </div>
            <div id="profile_image" class=" col-sm-12"><img src="/img/uploads/{{$user->Profile->Image->name}}" class="profile_pic justify-content-center"
                                         height="150" width="150" alt=" {{$user->username}} Profile Image"></div>
            <div id="badge" class="p-1 my-2">
                @if($user->Profile->is_crew ==1)
                    Crew Member
                    @endif
            </div>
        </div>

        <div class="col-sm-12" id="profile_name">{{$user->Profile->first_name}} {{$user->Profile->last_name}}</div>
    </div>
</div>

<div class="container">
    <div class="row text-center mx-1 mx-md-0 lb2">
        <div class="col-sm-12 col-md-4 my-1 p-1"><a href="{{$url->make("profile.view",["username"=>$user->username])}}" class="d-block py-2 p-1">Timeline</a></div>
        <div class="col-sm-12 col-md-4 my-1" p-1><a href="{{$url->make("profile.view",["username"=>$user->username])}}" class="d-block py-2">About</a></div>
        <div class="col-sm-12 col-md-4 my-1" p-1><a href="{{$url->make("profile.gallery.home",["username"=>$user->username])}}" class="d-block py-2">Gallery</a></div>
    </div>
</div>
