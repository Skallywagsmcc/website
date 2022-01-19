@extends("Layouts.Themes.BaseGrey.Admin")
@section("title")
@endsection

@section("content")


    @isset($request)
        @isset($request->error)
            <div class="container my-2">
                <div class="row box">
                    <div class="col-sm-12 head py-2 text-center text-left pl-lg-2">An Error Occurred</div>
                    <div class="col-sm-12 text-center py-2 mb-2">{{$error}}</div>
                    @isset($request->required)
                        @foreach($request->required as $required)
                            <div class="col-sm-12 pl-lg-2 mb-1">
                                {{str_replace("_"," ",$required)}} Required
                            </div>

                        @endforeach
                    @endisset
                </div>
            </div>
        @endisset
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center text-md-left pl-md-2"><a
                            href="{{$url->make("auth.admin.users.home")}}">Back to users list</a></div>
            </div>
        </div>


        @if($request->user->status >= 2)
            <div class="container my-2">
                <div class="row box">
                    <div class="col-sm-12 col-lg-4">
                        <div class="row px-0 mx-0">
                            <div class="col-sm-12 head mb-1 py-2">Profile Image</div>
                            <div class="col-sm-12 d-flex justify-content-center">
                                <img src="/img/uploads/{{$request->user->Profile->image->name}}"
                                     class="img-fluid border p-2 border-white border-1" alt="">
                            </div>
                        </div>

                        <div class="row px-0 mx-0">
                            <div class="col-sm-12 head py-2">Options</div>
                            <div class="col-sm-12 text-center"><a href="#" class="d-block py-2">View Profile</a></div>
                            <div class="col-sm-12 text-center"><a href="#" class="d-block py-2">Remove Account</a></div>
                        </div>

                    </div>
                    <div class="col-sm-12 col-lg-8">
                        <div class="row">
                            <div class="col-sm-12 head py-2 mb-1">Basic Information for
                                : {{$request->user->Profile->first_name}} {{$request->user->Profile->last_name}}</div>
                            <div class="col-sm-12 text-center text-lg-left pl-lg-3 py-2">Username
                                : {{$request->user->username}}</div>
                            <div class="col-sm-12 text-center text-lg-left pl-lg-3 py-2">Full Name
                                : {{$request->user->Profile->first_name}} {{$request->user->Profile->last_name}}</div>
                            <div class="col-sm-12 text-center text-lg-left pl-lg-3 py-2">Email Address
                                : {{$request->user->email}}</div>
                        </div>
                        <div class="row my-2">
                            <div class="col-sm-12 head py-2">About {{$request->user->Profile->first_name}}</div>
                            @if(!empty($request->user->Profile->about))
                                <div class="col-sm-12 py-2">{{nl2br($request->user->Profile->about)}}</div>
                            @else
                                <div class="col-sm-12 py-2 text-center">This Section has not been filled out yet.</div>
                            @endif
                        </div>


                        <div class="row my-2">
                            <div class="col-sm-12 head">Settings Applied</div>
                            <div class="col-sm-12 py-2">
                                {{$request->user->Profile->first_name}}'s Date of birth Visibility
                                : {{$request->user->settings->display_dob == 0 ? "Private" : "Public"}}
                            </div>
                            <div class="col-sm-12 py-2">
                                {{$request->user->Profile->first_name}}'s Fullname Visability
                                : {{$request->user->settings->display_full_name == 0 ? "Private" : "Public"}}
                            </div>
                            <div class="col-sm-12 py-2">
                                {{$request->user->Profile->first_name}}'s Email
                                : {{$request->user->settings->email == 0 ? "Private" : "Public"}}
                            </div>

                            <div class="col-sm-12 py-2">
                                {{$request->user->Profile->first_name}}'s has enabled two factor Authentication
                                : {{$request->user->settings->two_factor_auth == 0 ? "No" : "Yes"}}
                            </div>

                        </div>
                    </div>


                </div>

{{--                Ban will need to be added to a ban history--}}



                @if($request->disableform == false)
                <form action="{{$url->make("auth.admin.users.ban.store",["username"=>$request->user->username])}}"  method="post" class="row my-2 box">
                    {{csrf()}}
                        <div class="col-sm-12 head py-2"> Banning options for  {{$request->user->Profile->first_name}} (currently not in use)</div>
                        <div class="col-sm-12 py-2">
                            <label for="expire">How Long to ban for </label>
                            <select name="expire" class="form-control" id="">
                                <option value="+1 Week">One Week</option>
                                <option value="+28 days">28 Days</option>
                                <option value="+6 Months ">Six Months</option>
                                <option value="+1 Year">One Year</option>
                                {{--                                Lifetime ban will block login access--}}
                                <option value="lt">Lifetime</option>
                            </select>
                        </div>
                    <div class="col-sm-12 my-1">
                        <label for="password"> Your Password </label>

                        <div class="col-sm-12">
                            <label for="reason">Reason for Banning {{$request->user->Profile->first_name}}</label>
                            <textarea name="reason" id="" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <input type="password" class="form-control py-1" name="admin_pw"></div>
                        <div class="col-sm-12 text-right pr-lg-right">
                            <button class="btn btn btn-primary">Apply Ban</button>
                        </div>

                </form>
                    @else
                    <div class="row box">
                        <div class="col-sm-12 head py-2">Banning in progress</div>
                        <div class="col-sm-12">{{$request->user->Profile->first_name}} has recently been banned, this ban expires on : {{date("d/m/Y H:i:s",strtotime($request->BanExpires()))}}</div>
                        or click here to cancel ban <a href="{{$url->make("auth.admin.users.ban.delete",["id"=>base64_encode($request->user->id)])}}">Remove ban</a>
                    </div>
                @endif
            </div>


        @elseif($request->user->status == 1)
            <div class="container my-2">
                <div class="row box">
                    <div class="col-sm-12 head py-2 mb-1">Account Management For
                        : {{$request->user->Profile->first_name}} {{$request->user->Profile->last_name}}</div>
                    <div class="col-sm-12">This account is Still Set as pending and cannot be modified</div>
                </div>
            </div>
        @elseif($request->user->status == 0)
            <div class="container my-2">
                <div class="row box">
                    <div class="col-sm-12 head py-2 mb-1">Account Management For
                        : {{$request->user->Profile->first_name}} {{$request->user->Profile->last_name}}</div>
                    <div class="col-sm-12">This account is Still Set as Guest Account options are limited on this
                        account type
                    </div>
                </div>
            </div>
            {{--            Set up the options here for pending accounts--}}
        @endif



    @endisset

    {{--    <div class="container my-1">--}}
    {{--        <div class="row box">--}}
    {{--            <div class="col-md-12 head">Edit User Information for--}}
    {{--                : {{$request->user->first()->Profile->first_name}} {{ $request->user->Profile->last_name}}</div>--}}
    {{--        </div>--}}
    {{--    </div>--}}

    {{--    <div class="container my-1">--}}
    {{--        <div class="row box">--}}
    {{--            <div class="col-sm-12 py-2">--}}
    {{--                <form action="{{$url->make("auth.admin.users.update",["id"=>base64_encode($request->user->id)])}}" method="post" class="tld-form">--}}
    {{--                    {{csrf()}}--}}
    {{--                    <label for="username">Username (this CANNOT be Changed): </label>--}}
    {{--                    <input type="text" class="form-control" name="username"--}}
    {{--                           value="@isset($post){{$post->username}}@else{{$request->user->username}}@endisset">--}}
    {{--                    <div class="form-group text-right">--}}
    {{--                        <input type="hidden" class="id" name="id" value="@isset($user){{$request->user->id}}@endisset">--}}
    {{--                        <div class="form-row">--}}
    {{--                            <div class="form-group col-md-6">--}}
    {{--                                <label for="first_name">First name : </label>--}}
    {{--                                <input type="text" class="form-control tld-input" name="first_name" value="@isset($post){{$post->first_name}}@else{{$request->user->Profile->first_name}}@endisset">--}}
    {{--                            </div>--}}

    {{--                            <div class="form-group col-md-6">--}}
    {{--                                <label for="last_name">Last name : </label>--}}
    {{--                                <input type="text" class="form-control tld-input" name="last_name" value="@isset($post){{$post->last_name}}@else{{$request->user->Profile->last_name}}@endisset">--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <hr class="bg-light">--}}
    {{--                        <label for="email">Email Address : </label>--}}
    {{--                        <input type="text" class="form-control tld-input" name="email" value="@isset($post){{$post->email}}@else{{$request->user->email}}@endisset"--}}
    {{--                        <hr>--}}

    {{--                        <h2>Other Settings</h2>--}}
    {{--                        <label for="is_admin">Set this user as Administrator</label>--}}
    {{--                        <input type="checkbox" name="is_admin" @if($request->user->is_admin == 1) checked @endif value="1">--}}
    {{--                        <br>--}}
    {{--                        <label for="is_admin">Set this user as Crew Member</label>--}}
    {{--                        <input type="checkbox" name="is_crew" @if($request->user->Profile->is_crew == 1) checked @endif value="1">--}}

    {{--                        <div class="row">--}}
    {{--                            <div class="col-sm-12">--}}
    {{--                                <label for="admin_password">Your User Account password</label>--}}
    {{--                            </div>--}}
    {{--                            <div class="col-sm-12 my-2 py-2">--}}
    {{--                                <input type="password" class="form-control px-1" name="admin_password">--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <button class="btn btn-primary btn-block">Update User Details</button>--}}
    {{--                    </div>--}}
    {{--                </form>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
@endsection