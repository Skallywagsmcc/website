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
        <div class="row">
            <div class="col-sm-12 col-md-9 text-center">

                We have found {{$members->count()}} Registered Crew
                @if(($members->count() > 1) || $members->count() == 0)
                    Members
                @else
                    Member
                @endif


            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                @foreach($members as $member)
                    <div class="col-sm-12 col-md-4">

                        <img src="/img/uploads/{{$member->user->Profile->image->name}}"
                             alt="{{$member->user->username}}">
                    </div>
                @endforeach
            </div>

        </div>
    </div>


    <div class="container">
        <div class="row">
            <form action="{{$url->make("auth.admin.members.store")}}" method="post">
                @foreach($users as $user)
                    <div class="col-sm-12 col-md-6">{{$user->username}}</div>
                    <div class="col-sm-12 col-md-6"><input type="checkbox" name="id[]" value="{{$user->id}}"></div>
                @endforeach
                <button>save</button>
            </form>

        </div>
    </div>


@endsection