@extends("Layouts.backend")


@section("content")
    <div class="container">
        <div class="alert-dark">@isset($error)Error says : {{$error}}@endisset</div>
    </div>

    <div class="container px-0 px-md-2">
        <div class="head">Update Password</div>
        <div class="info px-0 px-2">
            <form action="{{$url->make("security.password.store")}}" method="post" class="tld-form ">
                {{csrf()}}
                <div class="form-group">
                    <label for="password">Your Old Password </label>
                    <input type="password" class="form-control tld-input" name="password">
                </div>
                <div class="form-row">
                    <div class="col-sm-12 col-md-6">
                        <label for="newpw">New Password</label>
                        <input type="password" class="form-control tld-input" name="newpw">
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <label for="confirm">Confirm Password</label>
                        <input type="password" class="form-control tld-input" name="confirm">
                    </div>
                </div>


                <hr class="text-black">
                <div class="my-1">
                    Please note that changing your password will log you out
                </div>

                <button class="my-2 btn tld-button btn-block">update Password</button>
            </form>
        </div>

    </div>

    {{--    the profile information will show down here.--}}

@endsection