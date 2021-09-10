@extends("Layouts.main")


@section("content")
    {{--    the profile information will show down here.--}}
    @include("Includes.Frontend.ProfileNav")

    <div class="container my-3">
        <div class="row">
            <div class="col-sm-12 head mx-3 mx-md-0">Gallery</div>
            @if($count >= 1)
                @foreach($user->images()->where("nvtug",0)->get() as $gallery)
                    <div class="col-sm-12 my-2 col-md-4 px sm-1">
                        <div class="col-sm-12 text-center">
                            <img class="p-0  my-2" src="/img/uploads/{{$gallery->name}}"  height="200" alt="{{$gallery->name}}">
                        </div>
                        <div class="col-sm-12 text-center"><a
                                    href="{{$url->make("profile.gallery.view",["username"=>$user->username,"id"=>base64_encode($gallery->id)])}}">View
                                image</a></div>
                    </div>
                @endforeach
            @else
                <div class="col-sm-12 text-center"><h3>Sorry! it seems that no images have been uploaded by this
                        user</h3></div>
            @endif
{{--            <div class="col-sm-12 d-flex justify-content-center">{!! $links !!}</div>--}}

        </div>
    </div>

@endsection