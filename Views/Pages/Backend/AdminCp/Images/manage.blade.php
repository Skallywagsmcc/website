@extends("Layouts.backend")

@section("title")
    Image Manager
@endsection

@section("content")

    @if($image->count() == 1)
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center"><a href="{{$url->make("auth.admin.images.home")}}" class="d-block py-2">Back
                    to Images Home </a></div>
        </div>
    </div>
    <div class="container my-2">
        <div class="row box">
            <div class="col-sm-12 head py-2 text-center text-md-left pl-md-1">Manage image {{$image->title}}</div>
        </div>
    </div>
    <div class="container my-2">

        <div class="row box">
            <div class="col-sm-12 p-2 d-md-flex justify-content-md-center">
                <img src="/img/uploads/{{$image->name}}" class="img-fluid" alt="{{$image->title}}">
            </div>
        </div>
    </div>

    <div class="container my-2">
        <div class="row box">
            <div class="col-sm-12 p-2 text-center">
                <a class="d-block" href="{{$url->make("auth.admin.images.delete",["id"=>base64_encode($image->id)])}}">Delete
                    Image</a>
            </div>
        </div>
    </div>
    {{--    This section needs to be linkjed to the users first grouped together and add a count section--}}
    @else
        <div class="container">
            <div class="row box">
                <div class="col-sm-12 head py-2 text-md-left text-center pl-md-1">No Image found</div>
            </div>
        </div>
        <div class="container">
            <div class="row box">
                <div class="col-sm-12 p-2 text-center">
                    No image has been found with that id <br><br> <a class="d-block" href="{{$url->make("auth.admin.images.home")}}"> Return to image
                        list</a>
                </div>
            </div>
        </div
        @endif

@endsection