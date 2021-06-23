<nav class="navbar navbar-expand-lg" id="navbar">
    <div class="navbar-brand">
        <img src="/img/logo.png"  height="60px" width="60px" alt="Logo">
    </div>
    <a href="#"  class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
       aria-expanded="false" aria-label="Toggle navigation">Menu</a>

    <div class="collapse navbar-collapse" id="navbarNav">

        <ul class="navbar-nav">
{{--            Predefined--}}
            <li class="nav-item active">
                <a class="nav-link" href="{{$url->make("homepage")}}">Home</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{$url->make("charters.home")}}">Our Charters</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{$url->make("articles.home")}}">Our Blog</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{$url->make("events.home")}}">Our Events</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{$url->make("members.home")}}">Our Members</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{$url->make("contact-us")}}">Contact us</a>
            </li>
        </ul>

    </div>

</nav>
