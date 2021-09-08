@extends("Layouts.main")

@section("title")
    Image found
@endsection

@section("content")
    @include("Includes.Frontend.ProfileNav")
    @isset($error)
        {{$error}}
    @endisset


    <div class="container">
        @if($count == 0)
            no page found Click this link here
        @else
            <div class="row text-center my-3 border-primary border bg-dark d-flex justify-content-center">
                <div class="col-sm-12 px-0">
                    <img src="/img/uploads/{{$image->name}}" class="img-fluid px-0"
                         alt="{{$image->name}}">
                </div>
                <div class="col-sm-12 py-3">
                    {{$image->description}}
                </div>

            </div>
    </div>


{{--        Disable this currently --}}
{{--

        @foreach($image->comments as $comment)
            {{  $comment->user->username}} Says :    {{$comment->comment}} @if($comment->user->id == \App\Http\Libraries\Authentication\Auth::id())
                |
                <a href="/profile/{{$comment->user->username}}/gallery/comment/delete/{{base64_encode($comment->id)}}">Delete
                    comment</a>
            @endif<br>

        @endforeach

        @if(Auth())
            <form action="/profile/{{$user->username}}/gallery/comments/add" method="post">
                {{csrf()}}
                <input type="text" name="id" value="{{$image->id}}">
                <textarea name="comment"></textarea>
                <br>Enter your password <br>
                <button>Save</button>
            </form>
        @else
            <hr>
            <h2 class="alert-dark text-center py-1">
                you must be logged in to post comments
            </h2>

        @endif--}}

    @endif

@endsection