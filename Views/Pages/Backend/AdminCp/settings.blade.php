@extends("Layouts.Themes.BaseGrey.Admin")
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
            <div class="col-sm-12 text-center text-lg-right pr-lg-2 py-2"><a class="d-block" href="{{$url->make("auth.admin.home")}}">Back
                    to Admin Home</a></div>
        </div>
    </div>
{{--    todo need to find a away to add multiple Addresses and Tephone Numbers to contact page may require a pivot table--}}
    <div class="container my-2">
        <form action="{{$url->make("auth.admin.settings.store")}}" method="post">
            {{csrf()}}
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
                <div class="col-sm-12 py-2 head">Site Settings : Manage Address</div>
            </div>

            <div class="row box m-2">
                <div class="col-sm-12 py-2 text-center"><a href="{{$url->make("auth.admin.addresses.home")}}" class="d-block">Manage Contact form Addresses</a></div>
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

            <div class="row my-2">
                <div class="col-sm-12">
                    <button class="btn btn-block btn-dark py-2 my-2">Update Settings</button>
                </div>
            </div>
        </form>
    </div>

@endsection