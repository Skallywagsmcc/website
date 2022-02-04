@extends("Layouts.Themes.BaseGrey.Account")
@section("title")
    Backend Control panel : Home
@endsection

@section("content")

    <div class="container">
        <div class="row box head">
            <div class="col-sm-12 head">User Activity Log</div>
        </div>
        @if($request->activity->count() >= 1)
            @foreach($request->activity as $activity)
                <div class="row box boxbg my-2">
                    <div class="col-sm-12 py-2 head text-lg-right pr-lg-2 text-center">{{$request->activity_date($activity->created_at)}}</div>
                    <div class="col-sm-12 py-2 text-center">
                        @if($activity->type == "profile_pic")
                            @if($activity->action == "upload")
                                You Uploaded a new Photo to your image
                                gallery {!!$request->showlink($activity->url,"View Image") !!}
                            @elseif($activity->action == "set")
                                You changed your Profile photo {!!$request->showlink($activity->url,"View Image") !!}
                            @endif
                        @elseif($activity->type == "image")
                            @if($activity->action == "upload")
                                You Uploaded a new Image to your image
                                gallery {!!$request->showlink($activity->url,"View Image") !!}
                            @elseif($activity->action == "delete")
                                You have deleted a an image from your Gallery,
                            @endif
                        @elseif($activity->type == "email")
                            @if($activity->action == "update")
                                You Have changed Your <b>Email Address </b> if this was not you : {!!$request->showlink($activity->url,"click here to change it") !!}
                            @endif
                        @elseif($activity->type == "password")
                            @if($activity->action == "update")
                                You Have changed Your <b>Password</b> if this was not you : {!!$request->showlink($activity->url,"click here to change it") !!}
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
                <div class="col-sm-12 head">No Results found</div>
                <div class="col-sm-12 text-center">Sorry it seems no activity Log has been listed currently</div>
            </div>
        @endif
    </div>

@endsection