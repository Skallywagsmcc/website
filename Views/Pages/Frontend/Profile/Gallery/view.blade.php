@extends("Layouts.main")

@section("title")
    Image found
@endsection

@section("content")
@include("Includes.ProfileNav")
    @isset($error)
        {{$error}}
    @endisset


    @if($count == 0)
        no page found Click this link here
    @else
    <div class="text-center">
        <img src="/img/uploads/{{$image->image_name}}" height="400" width="400"
             alt="{{$image->image_name}}">
        @if($image->user->id == \App\Http\Libraries\Authentication\Auth::id())
            <a href="/profile/{{$image->user->username}}/gallery/image/delete/{{base64_encode($image->id)}}">Delete image</a>
        @endif
    </div>


        @foreach($image->comments as $comment)
            {{  $comment->user->username}} Says :    {{$comment->comment}} @if($comment->user->id == \App\Http\Libraries\Authentication\Auth::id())
                | <a href="/profile/{{$comment->user->username}}/gallery/comment/delete/{{base64_encode($comment->id)}}">Delete comment</a>
            @endif<br>

        @endforeach


        <form action="/profile/{{$user->username}}/gallery/comments/add" method="post">
            {{csrf()}}
            <input type="hidden" name="id" value="{{$image->id}}">
            <textarea name="comment"></textarea>
            <br>Enter your password <br>
            <button>Save</button>
        </form>
    @endif

@endsection