@extends("Layouts.backend")

@section("title")
    Admin Panel : list users
@endsection

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center text-md-left pl-md-1 py-2">
                <a href="{{$url->make("auth.admin.home")}}">Back to admin home</a>
            </div>
        </div>
    </div>

        <div class="container">

            <form action="{{$url->make("auth.admin.users.search")}}" class="tld-form ">
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
            <div class="row box px-0">
                <div class="col-sm-12 px-0">
                    <h5 class="px-0 head">The Users Manager</h5>
                    <div class="py-2 px-md-1">
                     This section does exactly what it says on the tin, it allows you as an admin to manage a users account, Create a new user, or delete there account.
                        <br><br>
                        Want to add a Crew Member Status to your member visit the <a href="{{$url->make("auth.admin.members.home")}}">Members Section</a> and apply this role to the users account
                        <hr>
                        <h5 class="text-center"> ** Please note that this does not give the users with Member status any extra Privileges **</h5>
                        </h5>
                    </div>

                </div>
            </div>
        </div>

        <div class="container box my-2">
            <div class="col-sm-12 text-md-right text-center py-2">
                <a href="{{$url->make("auth.admin.users.new")}}" class="d-block">Create a New User</a>
            </div>
        </div>


    <div class="container">
        <div class="row px-0">
            <div class="col-sm-12 col-md-3">
                <div class="col-sm-12 box px-0">
                    <div class="head">Newest Accounts</div>
                    @foreach($latest as $u)
                        <div class="col-sm-12 text-center">
                            {{$u->username}}
                        </div>
                    @endforeach
                </div>

            </div>
            <div class=" col-sm-12 col-md-9 box px-0">
                <div class="col-sm-12 px-0">
                    <div class="head">Profiles</div>
                    <div class="row my-2">
                        @foreach($users as $user)
                            <div class="col-sm-12 col-md-4 text-center">
                                <div class="col-sm-12 px-0">
                                    @if((is_null($user->Profile->profile_pic)) ||(!file_exists("./img/uploads/".$user->Profile->image->name)) )
                                        <img class="" src="/img/logo.png" alt="{{$user->Profile->image->title}}" height="200" width="200"/>
                                    @else
                                        <img class="" src="/img/uploads/{{$user->Profile->image->name}}" alt="{{$user->Profile->image->title}}" height="200" width="200"/>
                                    @endif
                                </div>
                                <div class="col-sm-12 px-0  my-2 py-2 text-center">
                                    <a href="{{$url->make("auth.admin.users.edit",["id"=>base64_encode($user->id),"username"=>base64_encode($user->username)])}}" class="d-block">Manage {{$user->username}}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
                </div>


        </div>
    </div>
@endsection