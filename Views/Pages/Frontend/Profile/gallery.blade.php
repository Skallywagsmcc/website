@extends("Layouts.main")


@section("content")
    {{--    the profile information will show down here.--}}
    @include("Includes.Frontend.ProfileNav")

    <div class="container my-3">
        <div class="row">
            <div class="col-sm-12 head mx-3 mx-md-0">Gallery</div>
            @if($request->images->count() >= 1)
                @foreach($request->images  as $image)

                    <img class="m-3" src="/img/uploads/{{$image->name}}" height="200" width="200"
                         alt="{{$image->image_name}}">
{{--                    <a href="{{$url->make("gallery.image.view",["username"=>$request->user->username,"id"=>base64_encode($image->id)])}}">--}}

{{--                    </a>--}}

                @endforeach
            @else
                echo "No Images have been found";
            @endif
            <div class="col-sm-12 d-flex justify-content-center">{!! $request->links !!}</div>

        </div>
    </div>

@endsection