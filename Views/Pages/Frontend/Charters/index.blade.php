@extends("Layouts.main")

@section("title")
    Charters : {{$chaters->title}}
@endsection


@section("content")

    <div class="container my-2">
        <div class="row lb2 base_border my-lg-3 mx-1 mx-md-0">
            <div class="col-sm-12 col-lg-3 text-center text-lg-right pr-lg-2  py-2">
                Our Newest Charter :
            </div>
            <div class="col-sm-12 col-lg-6 text-center  py-2">
                {{$latest->title}}
            </div>
            <div class="col-sm-12 col-lg-3 text-center  py-2">
                <a href="{{$url->make("charters.view",["slug"=>$latest->slug])}}" class="d-block">View Charter</a>
            </div>
        </div>
    </div>


    <div class="container my-2">
        <div class="row">

            @foreach($charters as $charter)
                <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                    <div class="col-sm-12 mx-0 ">
                        <div class="d-flex justify-content-center">
                            <img src="/img/uploads/{{$charter->image->name}}" alt="" class="profile_pic m-1" height="200px" width="200px">
                        </div>
                        <div class="text-center my-2 lb2 base_border"><a href="{{$url->make("charters.view",["slug"=>$charter->slug])}}" class="d-block py-2">{{$charter->title}}</a></div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection