@extends("Layouts.backend")

@section("title")
    Admin panel Settings
@endsection

@section("content")

    @isset($error)
    <div class="container">
        <div class="row box">
            <div class="col-sm-12 head">An Error Occurred</div>
            {{$error}}
            @isset($rmf)
                @foreach($rmf  as $required)
                    {{$required}}
                @endforeach
                @endisset
        </div>
    </div>
    @endisset

    <div class="container my-2">
        <div class="row">
            <div class="col-sm-12 text-center text-lg-right pr-lg-2 py-2"><a class="d-block"
                                                                             href="{{$url->make("auth.admin.home")}}">Back
                    to Admin Home</a></div>
        </div>
    </div>

    <div class="container my-2">
        <form action="{{$url->make("auth.admin.settings.store")}}" method="post">

            <div class="row box my-2">
                <div class="col-sm-12 py-2 head">Site Settings : Contact Email Address:</div>
                <div class="col-sm-12">
                    <input type="text" class="form-control my-2" name="email" value="{{$settings->contact_email}}">
                </div>
            </div>

            <div class="row box my-2">
                <div class="col-sm-12 py-2 head">Site Settings : Contact Telephone Number</div>
                <div class="col-sm-12">
                    <input type="text" class="form-control my-2" name="telephone"
                           value="{{$settings->contact_telephone}}">
                </div>
            </div>

            <div class="row box my-2">
                <div class="col-sm-12 py-2 head">Site Settings : Contact Address</div>
                <div class="col-sm-12">
                    <textarea rows="10" class=" form-control my-2">{{$settings->contact_address}}</textarea>
                </div>
            </div>

            <div class="row my-2 box">
                <div class="col-sm-12 head py-2">Site Settings : maintainence Status</div>
                <div class="col-sm-12">
                    <select name="maintainence_status" class="form-control py-2 bg-dark text-white my-2" id="">
                        @if($settings->maintainence_status == 1)
                            <option class="py-2" value="1"> Current Selection : Maintainence Mode off</option>
                        @else
                            <option class="py-2" value="0"> Current Selection : Maintainence Mode on</option>
                        @endif
                        <option class="py-2" value="0">Turn on Maintainence Mode</option>
                        <option class="py-2" value="1">Turn off Maintainence Mode</option>
                    </select>
                </div>
            </div>

            <div class="row my-2 box">
                <div class="col-sm-12 head py-2">Site Settings : Login Control</div>
                <div class="col-sm-12">
                    <select name="open_login" class="form-control py-2 bg-dark text-white my-2" id="">
                        @if($settings->open_login == 1)
                            <option class="py-2" value="1"> Current Selection : public Login</option>
                        @else
                            <option class="py-2" value="0"> Current Selection : Admin only login</option>
                        @endif
                        <option class="py-2" value="0">Set to Admin Only Login</option>
                        <option class="py-2" value="1">Set to public Login</option>
                    </select>
                </div>
            </div>
            <div class="row my-2 box">
                <div class="col-sm-12 head py-2">Site Settings : Registration Control</div>
                <div class="col-sm-12">
                    <select name="open_registration" class="form-control py-2 bg-dark text-white my-2" id="">
                        @if($settings->open_registration == 1)
                            <option class="py-2" value="1"> Current Selection : public Registration</option>
                        @else
                            <option class="py-2" value="0"> Current Selection : Invite Only registration</option>
                        @endif
                        <option class="py-2" value="0">Set to Invite only registration</option>
                        <option class="py-2" value="1">Set to public Registration</option>
                    </select>
                </div>
            </div>

            <div class="row my-2 box">
                <div class="col-sm-12 head py-2">Site Settings : Lock Submissions (dangerous)</div>
                <div class="col-sm-12">
                    Only use this Setting if you believe your system has been comprimised this will turn off all Post submisions as a security measurement.
                    <br><br>this will include "Login", "Registration" and "contact us"
                    <br><br>will block any requests to the website internally and externally including any api requests if amy are configured
                    <br><br>
                    Please only use this if you know what you are doing and have a method of reactivating this setting in your database.
                    <br><br> Please set  <kbd>lock_submissions=0</kbd> in your database to reactivate these settings
                    <br><br>
                    Please consider Setting your login and registration to private before choosing this option as this setting will also log you out and both login and register will be set to private.
                </div>
                <div class="col-sm-12 py-2 text-white bg-danger text-center my-2">
                    i confirm that i have read the Above statement and wish to continue to lock all submissions : <input
                            type="checkbox" name="lock_submissions" @if($post->lock_submissions == 1) checked @endif value="1" class="bg-dark">
                </div>
                <div class="col-sm-12">
                    <textarea name="lock_message" class="form-control" id="" rows="10"></textarea>
                </div>
            </div>
            <div class="row my-2">
                <div class="col-sm-12">
                    <button class="btn btn-block btn-dark py-2 my-2">Update Settings</button>
                </div>
            </div>
        </form>
    </div>


    {{--            <div class="row box my-2">--}}
    {{--                <div class="col-sm-12 head py-2">--}}
    {{--                    <label for="telephone">Contact Telephone  (optional):</label>--}}
    {{--                </div>--}}
    {{--                <div class="col-sm-12 p-2">--}}
    {{--                    <input type="telephone" class="form-control" name="telephone" value="{{$settings->contact_telephone}}">--}}
    {{--                </div>--}}
    {{--            </div>--}}

    {{--            <div class="form-group">--}}
    {{--                <div class="col-sm-12 text-center text-lg-left pl-lg-2">--}}
    {{--                    <label for="address">Address</label>--}}
    {{--                </div>--}}
    {{--                <div class="cpl-sm-12">--}}
    {{--                    <textarea rows="10" class=" form-control">{{$settings->contact_address}}</textarea>--}}
    {{--                </div>--}}
    {{--            </div>--}}

    {{--            <div class="col-sm-12 my-2">--}}
    {{--                <button class="btn btn-block py-2">Save</button>--}}
    {{--            </div>--}}
    {{--        </form>--}}
    {{--    </div>--}}

    {{--    <div class="container my-2">--}}
    {{--        <div class="row col-sm-12 py-2">--}}
    {{--            <form action="{{$url->make("auth.admin.settings.store")}}" method="post">--}}
    {{--                {{csrf()}}--}}

    {{--                Email Address   : <input type="text" name="email" value="{{$settings->contact_email}}"><br>--}}
    {{--                Maintainence Mode : <select name="maintainence_status" id="">--}}

    {{--                    Current Selection : @if($settings->maintainence_status == 1)--}}
    {{--                        <option value="1">Maintainence Mode off</option>--}}
    {{--                    @else--}}
    {{--                        <option value="0">Maintainence Mode on</option>--}}
    {{--                        @endif--}}
    {{--                    <option value="0">Turn on Maintainence Mode</option>--}}
    {{--                    <option value="1">Turn off Maintainence Mode</option>--}}
    {{--                </select>--}}
    {{--                <label for="password"> Your Password (required)</label><br>--}}
    {{--                <input type="password" name="password">--}}
    {{--                <button class="btn btn-primary btn-block">Save</button>--}}
    {{--            </form>--}}
    {{--        </div>--}}
    {{--    </div>--}}

@endsection