@extends("Layouts.main")

@section("title")
    Login to your account
@endsection
@section("head")
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
        function onSubmit(token) {
            document.getElementById("login-form").submit();
        }
    </script>
@endsection
@section("content")

    <div class="container">
        <div class="row">
            @if($request['access'] == "restricted")
                <div class="col-sm-12 head">Access denied</div>
                <div class="col-sm-12">Access is only Accessable to Authenticated users</div>
            @endif
            @isset($error)
                <div class="col-sm-12 head">An error Occurred</div>
                @if($error == "required")
                    <h2>Please check the required fields</h2>
                    @foreach($validate::$values as $value)
                        {{$value}}  Missing <br>
                    @endforeach
                @else
                    {{$error}}
                @endif
            @endisset
        </div>


    </div>

    <a href="{{$url->make("account.home")}}">Admin</a>

    <div class="container my-2">
        <div class="row mx-lg-0 mx-1">

            <div class="col-sm-12 col-lg-8 ">
                <div class="col-sm-12 head">Login To your account</div>
                <div class="col-sm-12">
                    <form action="{{$url->make("login.store")}}@isset($request["ref"]){{"?ref=".$request["ref"]}}@endisset"
                          method="post" class="tld-form" id="login-form">
                        <div class="form-group tld-form">
                            <label for="username">Your Username/Email Address</label>
                            <input type="text" name="username" class=" form-control tld-input"
                                   value="@isset($username){{$username}}@endisset"
                                   placeholder="Email Address or username">
                        </div>
                        {{--            Password--}}
                        <div class="form-group">
                            <label for="password">Your Password</label>
                            <input type="password" name="password" class="form-control tld-input"
                                   placeholder="Password">
                        </div>
                        <div class="form-row my-1">
                            <div class="col-sm-6 text-md-right text-center">
                                <label for="remember">Remember Me for 7 days</label>
                            </div>
                            <div class="col-sm-6 text-center">
                                <input type="checkbox" name="remember" value="1" class="tld-input">
                            </div>
                            <button class="g-recaptcha btn btn-block tld-button my-2"
                                    data-sitekey="6LcklagdAAAAAAb7fXVtUQAdaJMPWk68K_pqztt4"
                                    data-callback='onSubmit'
                                    data-action='login'>Login
                            </button>
                        </div>

                    </form>

                </div>
            </div>

            <div class="col-sm-12 col-lg-4">
            <div class="col-sm-12 head">More Options</div>
                @isset($value)
                    @if($value->open_registration==true)
                        <div class="col-sm-12 text-center"><a href="{{$url->make("register")}}" class="d-block py-2">Register for an account</a>
                        </div>
                    @endif
                @endisset

                <div class="col-sm-12 text-center"><a href="{{$url->make("passwordreset.home")}}" class="d-block py-2">Reset Password</a></div>
            </div>
        </div>
    </div>

    <div class="container my-2">
        <div class="row">
            @isset($value)
                @if($value->open_registration==true)
                    <div class="col-sm-12 text-right"><a href="{{$url->make("register")}}">Register for an account</a>
                    </div>
                @endif
            @endisset
        </div>
    </div>
@endsection