@extends("Layouts.main")

@section("title")
    Charters : {{$chaters->title}}
@endsection


@section("content")


    <div class="container my-2">
        <div class="row">
           <div class="col-sm-12 text-center text-lg-right pl-lg-right-3"><a class="d-block py-2"
                                                                              href="{{$url->make("charters.home")}}">Back
                    to charters</a></div>
        </div>
    </div>

    <div class="container my-2">
        <div class="row mx-1 mx-md-0">
            <div class="col-sm-12 px-0" id="cover_base">

                <div class=" col-xs-12 px-0" id="cover_image">
                    <img src="/img/uploads/covers/{{$charter->CoverImage->name}}"
                         alt=" {{$user->username}} Profile Image">
                </div>

                <div id="profile_image" class=" col-sm-12"><img src="/img/uploads/{{$charter->image->name}}"
                                                                class="profile_pic justify-content-center"
                                                                height="150" width="150"
                                                                alt=" {{$charter->image->title}}"></div>
            </div>

            <div class="col-sm-12" id="profile_name">{{$charter->title}} </div>
        </div>
    </div>

    <div class="container my-2">
        <div class="row mx-1 mx-lg-0">
            <div class="col-sm-12 p-0">
                <div class="row mx-0">
                    <div class="col-sm-12 head my-2 lb1 ">About the charter</div>
                    <div class="col-sm-12 py-2 lb2">
                        {{$charter->content}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-2">
        <div class="row mx-1 mx-lg-0">
            <div class="col-sm-12 col-lg-6 text-center py-2 lb2 my-2 my-lg-0">
                @if($charter->updated_at > $charter->created_at)
                    Updated: {{date("d/m/Y : H:i",strtotime($charter->updated_at))}}
                @else
                    Created : {{date("d/m/Y : H:i",strtotime($charter->created_at))}}
                @endif


            </div>
            <div class="col-sm-12 col-lg-6 my-2 my-lg-0 lb2 py-2 text-center">Created by :
                <a href="{{$url->make("profile.view",["username"=>$charter->user->username])}}">{{$charter->user->Profile->first_name}} {{$charter->user->Profile->last_name}}</a>
            </div>

        </div>
    </div>
@endsection