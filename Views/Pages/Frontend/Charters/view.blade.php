@extends("Layouts.main")

@section("title")
    Charters : {{$chaters->title}}
@endsection


@section("content")


    <div class="container">
        <div class="row">
            <h2 class="col-sm-12 text-center head py-2">Our Charters</h2>
        </div>
    </div>

    <div class="container my-2">
        <div class="row mx-1 mx-md-0">
            <div class="col-sm-12 px-0" id="cover_base">

                <div class=" col-xs-12 px-0" id="cover_image">
                    <img src="/img/uploads/{{$charter->CoverImage->name}}" alt=" {{$user->username}} Profile Image">
                </div>

                <div id="profile_image" class=" col-sm-12"><img src="/img/uploads/{{$charter->image->name}}" class="profile_pic justify-content-center"
                                                                height="150" width="150" alt=" {{$charter->image->title}}"></div>
            </div>

            <div class="col-sm-12" id="profile_name">{{$charter->title}} </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
{{--                Sidebar--}}
                <div class="col-sm-12 col-md-3 text-center my-1">
                            <div class="col-sm-12 head my-1 lb1">Our Charters</div>
                            @foreach($sidebar as $menu)
                                @if($menu->id == $charter->id)
                                    <div class="py-1 text-center lb2" >
                                        <a href="{{$url->make("charters.view",["slug"=>$menu->slug])}}" class="d-block py-2">{{$menu->title}}</a>
                                    </div>
                                @else
                                    <div class=" py-1 text-center lb2">
                                        <a href="{{$url->make("charters.view",["slug"=>$menu->slug])}}" class="d-block py-2">{{$menu->title}}</a>
                                    </div>
                                @endif

                            @endforeach
                    </div>

                <div class=" col-sm-12 col-md-9 my-1">
                    <div class="col-sm-12 my-2 lb2 py-2 text-center">This Charter Was Created by : {{$charter->user->username}}</div>
                    </div>

        </div>
    </div>
@endsection