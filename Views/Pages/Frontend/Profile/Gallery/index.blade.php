@extends("Layouts.main")

@section("title")
    {{$user->username}} Gallery
@endsection

@section("content")

    @include("Includes.ProfileNav")
    {{--    the profile information will show down here.--}}
    @if($count >= 1)

        @foreach($user->images as $images)
            {{$images->id}} <br>
            @endforeach
        @foreach($user->images as $gallery)

{{--            <a href="/profile/{{$user->username}}/gallery/image/{{base64_encode($gallery->id}}">--}}

            <a href="{{$url->make("gallery.image.view",["username"=>$user->username,"id"=>base64_encode($gallery->id)])}}">
                <img class="m-3" src="/img/uploads/{{$gallery->image_name}}" height="200" width="200"
                     alt="{{$gallery->image_name}}">
            </a>

        @endforeach

    @endif

    <form action="/profile/{{$user->username}}/gallery/upload" method="post" enctype="multipart/form-data">
        <input type="file" name="upload">
        <textarea name="description" class="form-control"></textarea>
        <button>Upload file</button>
    </form>
@endsection