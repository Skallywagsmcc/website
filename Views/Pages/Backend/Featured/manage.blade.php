@extends("Layouts.Themes.BaseGrey.Admin")


@section("title")
    Manage Featured Request
@endsection

@section("content")

    @if($count== 1)
    <div class="container">

        <div class="row px-0">
            <div class="col-sm-12 col-md-4 my-2">
                <div class="col-sm-12 text-center px-0">
                    <img src="/img/uploads/{{$featured->Image->name}}" alt=""
                         class="text-center img-fluid px-0 mx-auto mb-2">
                </div>

            </div>
            <div class="col-sm-12 col-md-8 my-2 px-0">

                <div class="col-sm-12 box px-0 text-center text-md-left">
                    <div class="head">Image Description</div>
                    <div class="px-1">
                        {{$featured->Image->description}}
                    </div>
                </div>

                <div class="box col-sm-12 mt-2 px-0">
                    <div class="head">Image Details</div>
                    <div class="text-center px-1">Image Uploaded by
                        : {{$featured->Image->user->Profile->first_name}}  {{$featured->Image->user->Profile->last_name}}
                        ({{$featured->Image->user->username}})
                    </div>
                    <div class="text-center px-1">Request Made
                        on {{date("d/m/y : H:i a",strtotime($featured->created_at))}}</div>
                    <div class="text-center px-1"> Request Status
                        @if($featured->status == 0)
                            Rejected
                        @elseif($featured->status == 1)
                            Pending
                        @elseif($featured->status == 2)
                            Approved
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 px-0">
                <div class="col-sm-12 box px-0 text-center text-md-left mb-2 ">
                    <div class="head">
                        <div class="px-1">Instruction of usage</div>
                    </div>
                    <div class="text-center text-md-left px-1">
                        Approving users featured Image requests is a simple Process.
                        <ol class="text-center">
                            <li class="py-1">Approve Request : This will allow the request to be shown on the front page of the website.</li>
                            <li class="py-1">Deny Request : This will deny the request from the user and will not display.</li>
                            <li class="py-1">Cancel Request : This option is used if the request is made by the accident from the user, this will delete the request from the database forever and cannot be recovered.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

            <div class="row font-weight-bold text-center box px-0">
                <div class="col-sm-12 col-md-4"><a href="{{$url->make("auth.admin.featured.manage",["id"=>base64_encode($featured->id),"status" => 2])}}" class="d-block py-2">Accept Request</a></div>
                <div class="col-sm-12 col-md-4"><a href="{{$url->make("auth.admin.featured.manage",["id"=>base64_encode($featured->id),"status" => 0])}}" class="d-block py-2">Deny Request</a></div>
                <div class="col-sm-12 col-md-4"><a href="{{$url->make("auth.admin.featured.delete",["id"=>base64_encode($featured->id)])}}" class="d-block py-2">Cancel Request</a></div>
            </div>

    </div>
    @else
        <div class="container">
            <div class="row">
                <div class="col-sm-12 box">
                    <div class="head">Invalid Request</div>
                    Sorry it seems like the request you are looking for cannot be found, it may have changed name or been deleted
                    <a href="{{$url->make("auth.admin.featured.home")}}">Go Back to featuered Requests</a>
                </div>
            </div>
        </div>
    @endif


@endsection