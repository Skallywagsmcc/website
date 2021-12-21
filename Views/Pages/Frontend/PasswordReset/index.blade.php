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
                            step 2 : click on the link we have provided to take you to the required page. <hr>
                            Note : Please check your junk folder for these emails as free emails providers such as outlook mark them as spam.
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