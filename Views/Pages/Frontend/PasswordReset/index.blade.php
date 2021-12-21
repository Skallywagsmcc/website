@extends("Layouts.main")


@section("head")
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
        function onSubmit(token) {
            document.getElementById("password-request-form").submit();
        }
    </script>
@endsection
@section("content")

    @isset($value->error)
        <div class="container my-2">
            <div class="row">
                <div class="col-sm-12 head">An Error Occurred</div>
                <div class="col-sm-12">
                    {{$value->error}}
                    <br><br>
                    @isset($value->required)
                        @foreach($value->required as $required)
                            {{$required}} <br>
                        @endforeach
                    @endisset
                </div>


            </div>
        </div>

    @endisset

    @isset($value)
        <div class="container my-2">
            <div class="row">
                <div class="col-sm-12 col-lg-8">
                    @if($value->status == false)
                        {{--                DO a count to see if the request is valid--}}
                        <div class="col-sm-12 head">Password Reset : New Request</div>
                        <form action="{{$url->make("passwordreset.store")}}" method="post" class="tld-form"
                              id="password-request-form">
                            <div class="form-group">
                                <label for="emaik">Your Email Address</label>
                                <div class="col-sm-12 py-2">
                                    <input type="text" name="email" class="form-control tld-input">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button class="g-recaptcha btn btn-block tld-button my-2"
                                        data-sitekey="6LcklagdAAAAAAb7fXVtUQAdaJMPWk68K_pqztt4"
                                        data-callback='onSubmit'
                                        data-action='password_request'>Send Request
                                </button>
                            </div>
                        </form>
                    @else
                        <div class="col-sm-12 head">What happens?</div>
                        <div class="col-sm-12 text-center">
                            Thank you for submitting your request for a new password. <br>
                            for your security we have sent you instructions to your registered mail account explaining what you need to do next.
                            <hr>
                            step 1 : Go to your inbox of your registered email account. <br>
                            step 2 : click on the link we have provided to take you to the required page. <br>
                        </div>
                    @endif
                </div>
                <div class="col-sm-12 col-lg-4">
                    <div class="col-sm-12 head">More Help</div>
                </div>
            </div>
        </div>
    @endisset
@endsection



{{--        Form Request --}}
{{--@isset($value)--}}
{{--    <div class="row">--}}
{{--        @if($value->request->count() == 1)--}}

{{--            <div class="col-sm-12 col-lg-8">--}}
{{--                @if(date("d/m/Y H:i:s") < date("d/m/Y H:i:s",strtotime($value->request->first()->expires)))--}}
{{--                    <form action="" class="tld-form">--}}
{{--                        <div class="col-sm-12 head">Reset My Password</div>--}}
{{--                        <input type="text" name="token_hex" value="{{$token_hex}}">--}}
{{--                        <div class="form-group px-0">--}}
{{--                            <label for="">New Password </label>--}}
{{--                            <div class="col-sm-12 my-1"><input type="password" class="tld-input form-control"--}}
{{--                                                               name="password"></div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group px-0">--}}
{{--                            <label for="">Confirm New Password </label>--}}
{{--                            <div class="col-sm-12 my-1"><input type="password" class="tld-input form-control"--}}
{{--                                                               name="confirm"></div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group px-0">--}}
{{--                            <label for="">Token Key (this was emailed to you)</label>--}}
{{--                            <div class="col-sm-12"><input type="text" class="form-control tld-input"--}}
{{--                                                          name="token_key" placeholder="token_key"></div>--}}
{{--                        </div>--}}


{{--                        <button class="btn tld-button btn-block">Update Password</button>--}}
{{--                    </form>--}}
{{--                @else--}}
{{--                    <div class="col-sm-12 head">An Error Occurred</div>--}}
{{--                    <div class="col-sm-12 text-center">--}}
{{--                        Sorry It seems like the Password Request you have made has expired, Please either make a--}}
{{--                        new Request or login to your account--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--                @else--}}
{{--                    <div class="col-sm-12">--}}
{{--                        <form action="" method="post" class="tld-form">--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="emaik">Your Email Address</label>--}}
{{--                                <div class="col-sm-12 py-2">--}}
{{--                                    <input type="text" name="email" class="form-control tld-input">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-sm-12">--}}
{{--                                <button class="btn btn-block tld-button">Sent Request</button>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    </div>--}}
{{--@endisset--}}
