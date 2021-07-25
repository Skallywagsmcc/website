@extends("Layouts.backend")

@section("title")
    Image Manager
@endsection

@section("content")

    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center"><a href="{{$url->make("auth.admin.images.home")}}" class="d-block py-2">Back to Images Home </a></div>
        </div>
    </div>
    <div class="container">
        @if(($image->count() == 1))
            <div class="row">
                <div class="col-sm-12 head">Manage Image {{$image->title}}  </div>

                <img src="/img/uploads/{{$image->name}}" height="200" width="200"  class="m-2" alt="{{$image->title}}">

                {{--            Add Ability for admins to delete and unlink images here.--}}

                <div class="col-sm-12 text-center"><a href="{{$url->make("auth.admin.images.delete",["id"=>base64_encode($image->id)])}}">Delete Image</a></div>
            </div>
        {{--    This section needs to be linkjed to the users first grouped together and add a count section--}}
        @else
            <div class="row">
                <div class="col-sm-12"><a href="{{$url->make("auth.admin.images.home")}}">No Image found Return to image list</a></div>
            </div>
    @endif
    </div>



@endsection