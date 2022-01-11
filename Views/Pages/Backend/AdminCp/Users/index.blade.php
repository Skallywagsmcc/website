@extends("Layouts.Themes.BaseGrey.Admin")

@section("title")
    Admin Panel : list users
@endsection

@section("content")
    <div class="row box m-1 d-lg-none">
        <div class="col-sm-12 text-center text-md-left pl-md-1 py-2">
            <a href="{{$url->make("auth.admin.home")}}">Back to admin home</a>
        </div>
    </div>

    <div class="row box m-1">
        <div class="col-sm-12">
            <form action="{{$url->make("auth.admin.users.search")}}" class="tld-form ">
                <div class="form-row">
                    <div class="col-sm-12 col-md-9 my-3">
                        <input type="search" class="form-control tld-input" name="keyword"
                               placeholder="Search for a user">
                    </div>
                    <div class="col-sm-12 col-md-3 my-3 ">
                        <button class="btn btn-block btn-dark">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>





    <div class="row m-1">
        <div class="col-sm-12 text-md-right text-center py-2 new">
            <a href="{{$url->make("auth.admin.users.new")}}" class="p-2">Create a New User</a>
        </div>
    </div>

    {{--    <div class="container">--}}
    {{--        <div class="row px-0">--}}
    {{--            <div class="col-sm-12 col-md-3">--}}
    {{--                <div class="col-sm-12 box px-0">--}}
    {{--                    <div class="head">Newest Accounts</div>--}}
    {{--                    @foreach($latest as $u)--}}
    {{--                        <div class="col-sm-12 text-center">--}}
    {{--                            {{$u->username}}--}}
    {{--                        </div>--}}
    {{--                    @endforeach--}}
    {{--                </div>--}}

    {{--            </div>--}}
    {{--            <div class=" col-sm-12 col-md-9 box px-0">--}}
    {{--                <div class="col-sm-12 px-0">--}}
    {{--                    <div class="head">Profiles</div>--}}
    {{--                    <div class="row my-2">--}}
    {{--                        @foreach($users as $user)--}}
    {{--                            <div class="col-sm-12 col-md-4 text-center">--}}
    {{--                                <div class="col-sm-12 px-0">--}}
    {{--                                    @if((is_null($user->Profile->profile_pic)) ||(!file_exists("./img/uploads/".$user->Profile->image->name)) )--}}
    {{--                                        <img class="" src="/img/logo.png" alt="{{$user->Profile->image->title}}"--}}
    {{--                                             height="200" width="200"/>--}}
    {{--                                    @else--}}
    {{--                                        <img class="" src="/img/uploads/{{$user->Profile->image->name}}"--}}
    {{--                                             alt="{{$user->Profile->image->title}}" height="200" width="200"/>--}}
    {{--                                    @endif--}}
    {{--                                </div>--}}
    {{--                                <div class="col-sm-12 px-0  my-2 py-2 text-center">--}}
    {{--                                    <a href="{{$url->make("auth.admin.users.edit",["id"=>base64_encode($user->id)])}}"--}}
    {{--                                       class="d-block">Manage {{$user->username}}</a>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        @endforeach--}}
    {{--                    </div>--}}

    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}


    @foreach($request->user_groups as $group)
        <div class="container-fluid my-2">
            <div class="row box">
                <div class="col-sm-12 head py-2">
                    {{$request->statustype($group->status)}}
                </div>
            </div>
        </div>


        <div class="container-fluid my-2">
            <div class="row box">
                @foreach($request->getuser($group->status) as $user)
                    <div class="col-sm-12 col-lg-6 text-center py-2">
                        @if(empty($user->username) || (is_null($user->username)))
                            {{$user->email}}
                        @else
                            {{$user->username}}
                        @endif
                    </div>
                    <div class="col-sm-12 col-lg-6 text-center py-2"><a href="{{$url->make("auth.admin.users.edit",["id"=>base64_encode($user->id)])}}">Manager User Accounts</a></div>
                @endforeach
            </div>
        </div>

        <div class="row my-2 box">
            <div class="col-sm-12 text-center text-lg-right pr lg-3">View All {{$request->statustype($group->status)}}</div>
        </div>
    @endforeach
    @if($settings->where("open_registration",0)->count()==1)
        <div class="container my-2">
            <div class="row box">
                <div class="col-sm-12 head py-2 text-center text-lg-left pl-lg-2">Manager User Requests</div>
            </div>

        </div>
        </div>
    @endif
@endsection