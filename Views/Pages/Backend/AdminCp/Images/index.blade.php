@extends("Layouts.backend")

@section("title")
    Image Manager
@endsection

@section("content")
    <div class="container">

        <form action="{{$url->make("auth.admin.images.search")}}" class="tld-form">
            <div class="form-row">
                <div class="col-sm-12 col-md-9 my-3">
                    <input type="search" class="form-control tld-input" name="keyword" placeholder="Search for a user">
                </div>
                <div class="col-sm-12 col-md-3 my-3 ">
                    <button class="btn btn-block btn-dark">Search</button>
                </div>
            </div>
        </form>
    </div>


    <div class="container">

        {{--    This section needs to be linkjed to the users first grouped together and add a count section--}}
        <div class="row">
            <div class="col-sm-12 head">Manage Uploaded Images  </div>
            @foreach($images  as $image)
                <div class="col-sm-12 col-md-3 my-2">
                    <div class="col-sm-12 border border-primary py-1">
                        <img src="/img/uploads/{{$image->name}}" height="200" width="200" alt="">
                    </div>
                    <div class="col-sm-12 border border-primary my-1"><a href="{{$url->make("admin.images.manage",["username"=>$image->user->username,"id"=>base64_encode($image->id)])}}">Manage Images</a></div>
                </div>
            @endforeach
        </div>
    </div>


@endsection