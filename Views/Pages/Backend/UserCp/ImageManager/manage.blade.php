@extends("Layouts.backend")


@section("title")
    Image Manager : Manage Image
@endsection

@section("content")
    <div class="container my-3">

        <div class="row">

            <div class="col-sm-12 text-center">
                <a href="{{$url->make("images.gallery.home")}}">Back to images Manager</a>
            </div>
        </div>

        <div class="head">Edit Image {{$image->title}}</div>
        <form action="" class="info tld-form">
            <div class="form-row">
                <div class="col-sm-12">
                    {{csrf()}}
                </div>
            </div>
            <div class="form-row">
                <div class="col-sm-12 col-md-6">
                    <img src="/img/uploads/{{$image->name}}" alt="{{$image->title}}" height="250" width="250" class="p-3">
                </div>
            </div>
        </form>


    </div>

@endsection