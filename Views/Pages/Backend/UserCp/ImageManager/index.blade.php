@extends("Layouts.backend")


@section("title")
    Image Manager Home
    @endsection

@section("content")
    <div class="container my-3">
        <div class="row">
            <div class="col-sm-12 col-md-3 px-0 px-md-2 my-1 ">
                <div class="col-sm-12 px-0 px-md-2">
                    <div class="head py-2">Menu</div>
                    <div class="info">
                        <div><a href="{{$url->make("images.gallery.list")}}">Manage My Gallery</a></div>
                        <div><a href="{{$url->make("images.gallery.add")}}">Upload to Gallery</a></div>
                        <div><a href="{{$url->make("images.gallery.requests")}}">Featured Images Manager</a></div>
                        <div><a href="{{$url->make("images.gallery.requests")}}">Update Profile Picture</a></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-9 px-0 px-md-2 my-1">
                <div class="col-sm-12 px-0 px-md-2">
                    <div class="head py-2">Image Manager Home</div>
                    <div class="info px-1 text-center text-md-left">
                        Welcome to your User Control panel, this page is just a splash screen to give you a break down of  your profile
                        and any information you have provided.
                        <br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection