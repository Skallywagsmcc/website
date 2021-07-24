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
        
        {{--    This section needs to be linkjed to the users first grouped together and add a count section--}}
        <div class="row">
            <div class="col-sm-12 head">Manage Image {{$image->title}}  </div>

            <img src="/img/uploads/{{$image->image_name}}" height="200" width="200" alt="{{$image->title}}">

{{--            Add Ability for admins to delete and unlink images here.--}}

            <form action="# class="tld-form">

            </form>
        </div>
    </div>


@endsection