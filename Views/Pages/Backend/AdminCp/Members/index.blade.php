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
        <div class="row box">
            <div class="col-sm-12 px-0">
                <h5 class="px-0 head">Using Members Manager</h5>
                <div class="py-2">
                    Setting up your Bike crew Members could not be simpler, All you need to do is simply Click the link below the profile image in the two sections below.
                    <br><br>One Section lists all the users who are currently listed as part of your crew the other is list of standard users.

                    <br><br>
                    if you are looking at managing user accounts please <a href="{{$url->make('auth.admin.users.home')}}">Click here</a> as this section is only for Promoting and Demoting
                    Crew Member Status
                    <br><br>

                    <h5>
                        * please note this is only a Status this does not give any extra privileges to the users account.
                    </h5>
                </div>

            </div>
        </div>
    </div>

    <div class="container mb-2">
        <div class="row my-1 box">
            <div class="col-sm-12 px-0">
                <h5 class="head">Crew Members({{$members->count()}})</h5>
            </div>
            @foreach($members as $member)
                @if($member->user->CountMembers($member->user->id) == 1)
                    <div class="col-sm-12 col-md-3 text-center">
                        <h6>{{$member->user->username}}</h6>
                        @if(\App\Http\Models\Profile::where("user_id",$member->user_id)->get()->first()->profile_pic == null)
                        <img src="/img/logo.png" height="100" width="100" alt="{{$member->user->username}}">
                        @else
                            <img src="/img/uploads/{{$member->user->Profile->image->name}}" height="100" width="100" alt="{{$member->user->username}}">
                            @endif
                        <div><a href="{{$url->make("auth.admin.members.remove",["id"=>$member->id])}}">Set As Standard member</a></div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    {{--    list of members here--}}

    <div class="container">
        <div class="row my- box ">
            <div class="col-sm-12 px-0">
                <h5 class="head ">Standard Users</h5>
            </div>
            @foreach($users as $user)
                @if($user->CountMembers($user->id) == 0)
                    <div class="col-sm-12 col-md-3 text-center">
                        <h6>{{$user->username}}</h6>
                        @if(\App\Http\Models\Profile::where("user_id",$user->id)->get()->first()->profile_pic == null)
                            <img src="/img/logo.png" height="100" width="100" alt="{{$member->user->username}}">
                        @else
                            <img src="/img/uploads/{{$member->user->Profile->image->name}}" height="100" width="100" alt="{{$member->user->username}}">
                        @endif
                        <div><a href="{{$url->make("auth.admin.members.add",["id"=>$user->id])}}">Set As Crew member</a></div>
                    </div>
                @endif
            @endforeach
            <div class="col-sm-12 d-flex"></div>
        </div>
    </div>
@endsection