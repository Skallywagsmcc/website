@extends("Layouts.Themes.BaseGrey.Admin")

@section("title")
    Admin Panel : Home
@endsection

@section("content")

    {{md5("test12345")}}
    <div class="container">
        <div class="row box head">
            <div class="col-sm-12 head">Admin Activity Log</div>
        </div>
        @if($request->activity->count() >= 1)
            @foreach($request->activity as $activity)
                <div class="row box boxbg my-2">
                    <div class="col-sm-12 py-2 head text-lg-right pr-lg-2 text-center">{{$request->activity_date($activity->created_at)}}</div>
                    <div class="col-sm-12 py-2 text-center">
                        @if($activity->type == "address")
                            @if($activity->action == "create")
                                {!!$request->showlink($url->make("profile.home",["username",$activity->user->username]),$activity->user->username)!!}
                                has just created a new
                                Address {!!$request->showlink($activity->url,"Click here to see addresses") !!}
                            @elseif($activity->action == "update")
                                {!!$request->showlink($url->make("profile.home",["username",$activity->user->username]),$activity->user->username)!!}
                                has just updated an exisiting
                                Address {!!$request->showlink($activity->url,"Click here to see addresses") !!}
                            @elseif($activity->action == "delete")
                                {!!$request->showlink($url->make("profile.home",["username",$activity->user->username]),$activity->user->username)!!}
                                Deleted An Address

                            @endif

                        @elseif($activity->type == "article")
                            @if($activity->action == "create")
                                {!!$request->showlink($url->make("profile.home",["username",$activity->user->username]),$activity->user->username)!!}
                                Has just created a new Article : {!!$request->showlink($activity->url,"Click here to view Article") !!}
                            @elseif($activity->action == "update")
                                {!!$request->showlink($url->make("profile.home",["username",$activity->user->username]),$activity->user->username)!!}
                                has just updated an exisiting
                                Article {!!$request->showlink($activity->url,"Click to view Article") !!}
                            @elseif($activity->action == "delete")
                                {!!$request->showlink($url->make("profile.home",["username",$activity->user->username]),$activity->user->username)!!}
                                Deleted An Article
                            @endif

                        @elseif($activity->type == "user")
                            @if($activity->action == "create")
                                {!!$request->showlink($url->make("profile.home",["username",$activity->user->username]),$activity->user->username)!!}
                                Has just registered a new User Account. : {!!$request->showlink($activity->url,"Click here to Users list") !!}
                            @elseif($activity->action == "update")
                                {!!$request->showlink($url->make("profile.home",["username",$activity->user->username]),$activity->user->username)!!}
                                has just updated a users Account {!!$request->showlink($activity->url,"Click to view Article") !!}
                            @elseif($activity->action == "delete")
                                {!!$request->showlink($url->make("profile.home",["username",$activity->user->username]),$activity->user->username)!!}
                                Deleted A User Account
                            @endif

                        @elseif($activity->type == "event")
                            @if($activity->action == "create")
                                {!!$request->showlink($url->make("profile.home",["username",$activity->user->username]),$activity->user->username)!!}
                                Has just created a new Event : {!!$request->showlink($activity->url,"Click here to view Event") !!}
                            @elseif($activity->action == "update")
                                {!!$request->showlink($url->make("profile.home",["username",$activity->user->username]),$activity->user->username)!!}
                                has just updated an exisiting
                                Event {!!$request->showlink($activity->url,"Click to view event") !!}
                            @elseif($activity->action == "delete")
                                {!!$request->showlink($url->make("profile.home",["username",$activity->user->username]),$activity->user->username)!!}
                                Deleted An event
                            @endif

                        @elseif($activity->type == "resource")
                            @if($activity->action == "create")
                                {!!$request->showlink($url->make("profile.home",["username",$activity->user->username]),$activity->user->username)!!}
                                Has just created a new Resource : {!!$request->showlink($activity->url,"Click here to view Event") !!}
                            @elseif($activity->action == "update")
                                {!!$request->showlink($url->make("profile.home",["username",$activity->user->username]),$activity->user->username)!!}
                                has just updated an exisiting
                                Resource {!!$request->showlink($activity->url,"Click to view event") !!}
                            @elseif($activity->action == "delete")
                                {!!$request->showlink($url->make("profile.home",["username",$activity->user->username]),$activity->user->username)!!}
                                Deleted An Resource
                            @endif

                        @elseif($activity->type == "charter")
                            @if($activity->action == "create")
                                {!!$request->showlink($url->make("profile.home",["username",$activity->user->username]),$activity->user->username)!!}
                                Has just created a new charter : {!!$request->showlink($activity->url,"Click here to view charter") !!}
                            @elseif($activity->action == "update")
                                {!!$request->showlink($url->make("profile.home",["username",$activity->user->username]),$activity->user->username)!!}
                                has just updated an exisiting
                                charter {!!$request->showlink($activity->url,"Click to view event") !!}
                            @elseif($activity->action == "delete")
                                {!!$request->showlink($url->make("profile.home",["username",$activity->user->username]),$activity->user->username)!!}
                                Deleted An charter
                            @endif
                        @endif
                    </div>
                </div>
            @endforeach
            <div class="row">
                <div class="col-sm-12 text-center text-lg-right pr-lg-2"><a href="#" class="py-2">Clear User
                        Activity</a></div>
            </div>
            {!! $request->links !!}
        @else
            <div class="row box">
                <div class="col-sm-12 text-center">Sorry it seems no activity Log has been listed currently</div>
            </div>
        @endif
    </div>

@endsection
