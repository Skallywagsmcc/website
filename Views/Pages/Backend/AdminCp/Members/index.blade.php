@extends("Layouts.backend")

@section("title")
    Admin Panel : Members Home
@endsection



@section("content")
    <div class="container">
        <form action="{{$url->make("auth.admin.members.search")}}" class="tld-form">
            <div class="form-row">
                <div class="col-sm-12 col-md-9 my-3">
                    <input type="search" class="form-control tld-input" name="keyword"
                           placeholder="Search for a Member">
                </div>
                <div class="col-sm-12 col-md-3 my-3 ">
                    <button class="btn btn-block btn-dark">Search</button>
                </div>
            </div>
        </form>
    </div>


    <div class="container">
        <div class="row my-1">
            <div class="col-sm-12 box text-center">
                We have found {{$members->count()}} Registered Crew
                @if(($members->count() > 1) || $members->count() == 0)
                    Members
                @else
                    Member
                @endif
            </div>

            <div class="col-sm-12 col-md-8">
                <div class="box row my-1">
                    @foreach($users as $user)
                        <div class="col-sm-12 col-md-6">{{$user->username}}</div>
                        <div class="col-sm-12 col-md-6 text-center">
                            @if($user->CountMembers($user->id) == 1)
                                Standard Member : <a
                                        href="{{$url->make("auth.admin.members.remove",["id"=>$user->Members->id])}}">Set to
                                    standard User</a>
                            @else
                                Crew Members : <a href="{{$url->make("auth.admin.members.add",["id"=>$user->id])}}">Set to Crew
                                    member</a>

                            @endif
                        </div>
                    @endforeach
                </div>


            </div>

            <div class="col-sm-12 col-md-4 my-1  ">
                <div class="col-sm-12 box px-0">
                    <h5 class="text-center">Active crew members</h5>
                    @foreach($members as $member)
                        <div class="text-center border-bottom py-1">{{$member->user->username}}</div>
                    @endforeach
                </div>
                </div>


        </div>
    </div>



    <div class="container">
            @foreach($users as $user)
            <div class="row px-0 my-1 box py-1">
                <div class="col-sm-12 col-md-6 text-center text-md-left">{{$user->username}}</div>
                {{--                        <div class="col-sm-12 d block d-md-none p-0">--}}
                {{--                            <img src="/img/uploads/{{$user->Profile->image->name}}"   class="img-fluid" alt="{{$user->username}}">--}}
                {{--                        </div>--}}

            </div>
            @endforeach

        {!! $links !!}

    </div>


@endsection