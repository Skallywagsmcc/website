@extends("Layouts.main")

@section("head")
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
        function onSubmit(token) {
            document.getElementById("register-form").submit();
        }
    </script>
@endsection
@section("content")

    @if($request->isGuest() == false)


    @isset($request->error)
        <div class="container my-2">
            <div class="row lb2 mx-lg-1">
                <div class="col-sm-12 lb3 text-center text-lg-left pl-lg-1 head">An Error Occurred</div>
                <div class="col-sm-12 text-center">{{$request->error}}</div>
                @isset($request->required)
                    <ol>
                        @foreach($request->required as $required)
                            <li class="col-sm-12  text-center text-lg-left pl-lg-1 py-2">
                                {{$required}}
                            </li>
                        @endforeach
                    </ol>
                @endisset

            </div>
        </div>
    @endisset

    @if(($request->showform == true))
        <div class="container my-2">
            <div class="row my-2 lb3 mx-1">
                <div class="col-sm-12 head text-center text-lg-left pl-lg-2">Create An Account</div>
            </div>

            <form action="{{$url->make("register.store")}}" method="post" class="tld-form" id="register-form">
                <div class="form-row">
                    <div class="col-sm-12 mx-3">
                        <label for="username">Username</label>
                    </div>
                    @if((!is_null($request->token)))
                        <div class="col-sm-12">
                            <input type="hidden" name="token_hex" readonly value="@isset($request){{$request->token}}@endisset">
                        </div>
                    @endif
                    <div class="col-sm-12 mx-3">
                        <input type="text" class="form-control tld-input" name="username"
                               value="@isset($request){{$request->username}}@endisset">
                    </div>
                </div>

                <div class="form-row">homeView
                    <div class="col-sm-12 mx-3">
                        <label for="email">Email</label>
                    </div>
                    <div class="col-sm-12 mx-3">
                        <input type="text" class="form-control tld-input" @if(!is_null($request->token)))
                               @endif  name="email"
                               @isset($request)
                                       @if(!is_null($request->token))
                               value="{{$request->request->User->email}}"
                               @else
                                   value="{{$request->email}}"
                               @endif
                               @endisset>
                    </div>
                </div>




                <div class="form-row">
                    <div class="col-sm-12">
                        <label for="policy">Your Password Requires the following in order to follow our strong password Policy</label>
                        @foreach($request->ListPolicy() as $policy)
                            <div class="col-sm-12 text-left pl-lg-2">{{$policy}}</div>
                        @endforeach
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <div class="col-sm-12">
                            <label for="password">Password</label>
                        </div>
                        <div class="col-sm-12"><input type="password" class="form-control tld-input" name="password"/>
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-6">
                        <div class="col-sm-12">
                            <label for="confirm">Confirm password</label>
                        </div>
                        <div class="col-sm-12">
                            <input type="password" class="form-control tld-input" name="confirm">
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-sm-12 mx-3 my-2">
                        <hr>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-sm-12 col-lg-6">
                        <div class="col-sm-12"><label for="first_name">First Name </label></div>
                        <div class="col-sm-12"><input type="text" name="first_name" class="form-control tld-input"
                                                      value="@isset($request->first_name) {{$request->first_name}} @else @if(!is_null($request->token)){{$request->request->User->Profile->first_name}}@endif @endisset"></div>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <div class="col-sm-12"><label for="last_name">Last Name </label></div>
                        <div class="col-sm-12"><input type="text" name="last_name" class="form-control tld-input"
                                                      placeholder=""
                                                      value="@isset($request->last_name) {{$request->last_name}} @else @if(!is_null($request->token)){{$request->request->User->Profile->last_name}}@endif @endisset"></div>
                    </div>
                </div>

                <div class="row">
                    <label for="token_key">Token key</label>
                    @if(!is_null($request->token))
                        <div class="col-sm-12"><input type="text" class="form-control tld-input" name="token_key"></div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-sm-12 text-right my-2 mx-3">
                        <button class="g-recaptcha btn btn-primary"
                                data-sitekey="6LcklagdAAAAAAb7fXVtUQAdaJMPWk68K_pqztt4"
                                data-callback='onSubmit'
                                data-action='register'>Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    @endif
    @else
        <div class="container my-2">
            <div class="row">
                <div class="col-sm-12 head">Already logged in </div>
                <div class="col-sm-12 text-center py-2">You cannot register for a new Account as you are Currently logged in : go to my account <a href="{{$url->make("account.home")}}">My Account</a></div>
            </div>
        </div>
    @endif
@endsection()