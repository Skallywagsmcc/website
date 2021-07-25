@extends("Layouts.backend")


@section("title")
    Image Manager : List Images
@endsection

@section("content")
    <div class="container my-3">

        <div class="row my-3">
            <div class="col-sm-12 text-center">
                <a href="{{$url->make("images.gallery.home")}}">Back to images Manager</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 px-0 px-md-2">
                <div class="head py-2">Image Manager Home</div>
                <div class="info px-1 text-center text-md-left">
                    All images Are located below
                </div>
            </div>
            <div class="row my-3">
                @foreach($images as $image)
                    <div class="col-sm-12 col-md-4">
                        <div class="head">{{$image->title}}</div>
                        <div class="info">
                            <img src="/img/uploads/{{$image->name}}" height="300" width="100%" alt="$image->id">
                            <div><a href="{{$url->make("images.gallery.update",["id"=>$image->id])}}">Manage Image</a> | <a href="{{$url->make("images.gallery.delete",["id"=>$image->id])}}">Delete Image</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class=" col-sm-12 d-flex justify-content-center">
                {!! $links !!}
            </div>
        </div>
    </div>

@endsection