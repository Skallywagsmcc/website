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

            {{$image->description}}
            @if($image->user->id == \App\Http\Libraries\Authentication\Auth::id())
            <a href="{{$url->make("gallery.image.makepp",["username"=>$image->user->username,"id"=>base64_encode($image->id)])}}">Make Profile Picture</a> |

            @if($featured->status == 1)
                    Feature Request is pending : <a href="{{$url->make("gallery.image.submit",["username"=>$image->user->username,"id"=>base64_encode($image->id)])}}">Cancel Request</a>
                @elseif($featured->status  == 2)
                    Featured Request Approved : <a href="{{$url->make("gallery.image.submit",["username"=>$image->user->username,"id"=>base64_encode($image->id)])}}">Remove From Featured</a>
                @else
                    <a href="{{$url->make("gallery.image.submit",["username"=>$image->user->username,"id"=>base64_encode($image->id)])}}">Submit for feature Photo</a>
                @endif
                |
                <a href="/profile/{{$image->user->username}}/gallery/image/delete/{{base64_encode($image->id)}}">Delete image</a>
            @endif
        </div>

    @endif

@endsection