@extends("Layouts.main")


@section("content")
    {{--    the profile information will show down here.--}}
    @include("Includes.ProfileNav")

    <div class="container my-3">
        <div class="row">
            <div class="col-sm-12 head">Gallery</div>
            @if($count >= 1)
                @foreach($user->images as $gallery)
                    <div class="col-sm-12 my-2 col-md-4 px sm-1">
                        <div class="col-sm-12 text-center">
                            <img class="p-0  my-2" src="/img/uploads/{{$gallery->image_name}}"  height="200" alt="{{$gallery->image_name}}">
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



    {{--            --}}{{--            <a href="/profile/{{$user->username}}/gallery/image/{{base64_encode($gallery->id}}">--}}


    {{--        @endforeach--}}
    {{--    @else--}}
    {{--        echo "No Images have been found";--}}
    {{--    @endif--}}

    {{--    @if($user->id == $Auth::id())--}}
    {{--        <div class="row">--}}
    {{--            <form action="/profile/{{$user->username}}/gallery/upload" method="post" enctype="multipart/form-data">--}}
    {{--                {{csrf()}}--}}
    {{--                <input type="file" name="upload" class="form-control" >--}}
    {{--                <input type="text" name="title">--}}
    {{--                <textarea name="description" class="form-control my-1"></textarea>--}}
    {{--                <hr>--}}
    {{--                Make this my profile Picture        <input type="checkbox" name="ppic" value="1">--}}
    {{--                <button class="btn btn-block btn-primary my-1">Upload file</button>--}}
    {{--            </form>--}}
    {{--        </div>--}}
    {{--        @endif--}}
    {{--        </div>--}}



    {{--    <div class="row mt-1">--}}
    {{--        <div class="col-md-4">--}}
    {{--            <div class="head">{{$user->Profile->first_name}} {{$user->Profile->last_name }}</div>--}}
    {{--            <div class="text-center">--}}
    {{--               <div>@if(\App\Http\Libraries\Authentication\Auth::id() == $user->id) <a href="/account/edit/picture">Upload a profile picture</a> @endif</div>--}}
    {{--            </div>--}}
    {{--            <div class="text-center">--}}
    {{--                @include("Includes.ProfileNav")--}}

    {{--            </div>--}}
    {{--       </div>--}}
    {{--        <div class="col-md-8">--}}
    {{--            <div class="head">About {{$user->username}}</div>--}}
    {{--            {{$user->Profile->about}}--}}
    {{--        </div>--}}
    {{--    </div>--}}


@endsection