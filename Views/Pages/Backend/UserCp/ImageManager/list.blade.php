@extends("Layouts.backend")


@section("title")
    Image Manager : List Images
@endsection

@section("content")

    <div class="container my-2 px-0">
        <div class="row">
            <div class="col-sm-12 text-center text-md-right new pr-md-1 py-1">
                <a class="p-2" href="{{$url->make("images.gallery.add")}}">Upload New Image</a></div>
        </div>
    </div>

    @if($images->count() >= 1)
        <div class="container my-2">
            <div class="row box">
                <div class="col-sm-12 head py-2 text-center text-md-left pl-md-1">My Images</div>
            </div>
        </div>

        <div class="container my-2 px-0">
            <div class="row">
                @foreach($images as $image)
                    <div class="col-sm-12 col-md-4">
                        <div class="col-sm-12 box  tu text-center text-md-left pl-md-1 my-2 py-2">{{$image->title}}</div>
                        <div class="col-sm-12 px-0">
                            <img src="/img/uploads/{{$image->name}}" class="img-fluid" alt="$image->id">
                        </div>
                        <div class="box py-2 text-center my-2"><a class="d-block"
                                                                  href="{{$url->make("images.gallery.update",["id"=>$image->id])}}">Manage
                                Image</a></div>
                    </div>
                @endforeach
            </div>
        </div>

    @else
        <div class="container my-2">
            <div class="row box">
                <div class="col-sm-12 head py-2 text-center text-md-left pl-md-1">No Images Found</div>
            </div>

            <div class="container my-2 px-0">
                <div class="row box">
                    <div class="col-sm-12 p-2">Sorry it seems that you have not uploaded any images to the server, <a
                                href="{{$url->make("images.gallery.add")}}">Click here</a> to add some images
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{--                @foreach($images as $image)--}}
    {{--                    <div class="col-sm-12 col-md-4">--}}
    {{--                        <div class="head">{{$image->title}}</div>--}}
    {{--                        <div class="info">--}}
    {{--                            --}}
    {{--
    {{--                                <a href="{{$url->make("images.gallery.delete",["id"=>$image->id])}}">Delete Image</a>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                @endforeach--}}


@endsection