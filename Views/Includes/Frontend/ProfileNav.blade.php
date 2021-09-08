<div class="container my-2">
    <div class="row mx-1 mx-md-0">
        <div class="col-sm-12 coverimg">
            <div class="backimage"><img src="/img/bike.jpg" class="draggable"
                                        alt=" {{$user->username}} Profile Image"></div>
            <div class="frontimage"><img src="/img/uploads/{{$user->Profile->Image->name}}" class="profile_pic"
                                         height="150" width="150" alt=" {{$user->username}} Profile Image"></div>
            <div class="name">#{{$user->username}}</div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row mt-3 ">
        <div class="row event text-center px-0">
            <div class="col-sm-12 d-block d-md-none"><h2>Profile Menu</h2></div>
            <div class="col-sm-12 col-md-4 py-2"><a href="{{$url->make("profile.view",["username"=>$user->username])}}">About</a>
            </div>
            <div class="col-sm-12 col-md-4 py-2"><a
                        href="{{$url->make("profile.gallery.home",["username"=>$user->username])}}">Gallery</a></div>
        </div>
    </div>
</div>
