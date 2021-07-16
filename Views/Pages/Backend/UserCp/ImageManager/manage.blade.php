@extends("Layouts.backend")


@section("title")
    Image Manager : Manage Image
@endsection

@section("content")
    <div class="container my-3">

        <div class="row my-3">

            <div class="col-sm-12 text-center">
                <a href="{{$url->make("images.gallery.home")}}">Back to images Manager</a>
            </div>

        </div>


            <div class="row my-3">
                <img src="/img/uploads/{{$image->name}}" alt="{{$image->title}}" height="200" width="200">
            </div>

            <div class="row">
                <div class="col-sm-12">
                    {{ $image->description}}
                </div>
            </div>


            <hr>
            Request to be a featueed image
            Make Profile Photo
            Delete photo

    </div>

@endsection