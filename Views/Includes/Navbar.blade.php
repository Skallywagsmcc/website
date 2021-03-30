<nav class="navbar navbar-expand-lg" id="navbar">
    <div class="navbar-brand d-md-none d-block">
        <img src="/img/logo.png" class='d-md-none d-show' alt="Logo">
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        Menu
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">

        <ul class="navbar-nav">
{{--            Predefined--}}
            <li class="nav-item active">
                <a class="nav-link" href="{{$url->make("homepage")}}">Home</span></a>
            </li>
{{--            Dont add to many links --}}
            @foreach(\App\Http\Models\Category::all() as $category)
                <li class="nav-item">
                    <a class="nav-link" href="{{$url->make("pages.home",["category"=>$category->slug])}}">{{$category->title}}</a>
                </li>
            @endforeach
{{--            this is predefined--}}
            <li class="nav-item">
                <a class="nav-link" href="#">Contact us</a>
            </li>
        </ul>

        <ul class="ml-auto navbar-nav">
            <li class="nav-item dropdown">

                    @if(Auth())
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <img src="/img/uploads/{{\App\Http\Models\User::find(\App\Http\Libraries\Authentication\Auth::id())->Profile->Image->image_name}}" alt="" class="profile_pic">
                        {{\App\Http\Libraries\Authentication\Auth::getusername()}} </a>
                    @else
                        <a href="{{$url->make("login")}}">Login</a>
                    @endif
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{$url->make("profile.home",["username"=>\App\Http\Libraries\Authentication\Auth::getusername()])}}">View My Profile</a>
                    <a class="dropdown-item" href="{{$url->make("logout")}}">logout</a>
                </div>
            </li>
        </ul>
    </div>

</nav>