@extends("Layouts.Themes.BaseGrey.Account")
@section("title")
    Security : Change Password
@endsection

@section("content")

    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center text-md-left pl-md-1"><a href="{{$url->make("security.home")}}">Back to Security Home</a></div>
        </div>
    </div>

    @isset($error)
        <div class="container my-2">
            <div class="alert-dark">Error says : {{$error}}</div>
        </div>
    @endisset

    <div class="container my-2">
        <div class="row box">
            <div class="col-sm-12 py-2 text-center head">
                Change Account Password
            </div>
        </div>
    </div>


    <div class="container my-2">
        <div class="row box">
            <div class="col-sm-12 py-2">
                <form action="{{$url->make("security.password.store")}}" method="post" class="tld-form ">
                    {{csrf()}}
                    <div class="form-row mb-2">
                        <div class="col-sm-12 col-md-3 py-1 text-center text-md-right pr-md-1">
                            <label for="password">Your Old Password </label>
                        </div>
                        <div class="col-sm-12 col-md-9">
                            <input type="password" class="form-control tld-input" name="password">
                        </div>
                    </div>

                    {{--                    New pw--}}

                    <div class="form-row mb-2">
                        <div class="col-sm-12 col-md-3 py-1 text-center text-md-right pr-md-1">
                            <label for="password">Your new Password </label>
                        </div>
                        <div class="col-sm-12 col-md-9">
                            <input type="password" class="form-control tld-input" name="newpw">
                        </div>
                    </div>

                    {{--                    confirm pw--}}

                    <div class="form-row mb-2">
                        <div class="col-sm-12 col-md-3 py-1 text-center text-md-right pr-md-1">
                            <label for="password">Confirm New Password </label>
                        </div>
                        <div class="col-sm-12 col-md-9">
                            <input type="password" class="form-control tld-input" name="confirm">
                        </div>
                    </div>

                    <h5 class="text-center my-2">
                        Please note that changing your password will log you out
                    </h5>

                    <button class="my-2 btn tld-button btn-block">update Password</button>
                </form>
            </div>

        </div>

    </div>

    {{--    the profile information will show down here.--}}

@endsection