@extends("Layouts.main")

@section("title")
    {{$user->username}} Gallery
@endsection

@section("content")

    <div class="container">
        @include("Includes.ProfileNav")
        {{--    the profile information will show down here.--}}
        @if($count >= 1)
            @foreach($user->images as $gallery)

                {{--            <a href="/profile/{{$user->username}}/gallery/image/{{base64_encode($gallery->id}}">--}}

                <a href="{{$url->make("gallery.image.view",["username"=>$user->username,"id"=>base64_encode($gallery->id)])}}">
                    <img class="m-3" src="/img/uploads/{{$gallery->image_name}}" height="200" width="200"
                         alt="{{$gallery->image_name}}">
                </a>

            @endforeach
            @if($user->id == $auth::id())
                <div class="row">
                    <form action="/profile/{{$user->username}}/gallery/upload" method="post" enctype="multipart/form-data">
                        {{csrf()}}
                        <input type="file" name="upload" class="form-control" >
                        <input type="text" name="title">
                        <textarea name="description" class="form-control my-1"></textarea>
                        <hr>
                        Make this my profile Picture        <input type="checkbox" name="ppic" value="1">
                        <button class="btn btn-block btn-primary my-1">Upload file</button>
                    </form>
                </div>

            @else
                <div class="row">
                    Please Login to upload images
                </div>
            @endif
        @else
        @endif
    </div>




@endsection