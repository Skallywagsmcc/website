@extends("Layouts.main")

@section("head")
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
        function onSubmit(token) {
            document.getElementById("activation-form").submit();
        }
    </script>
@endsection
@section("content")



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
                <div class="col-sm-12 head text-center text-lg-left pl-lg-2">Setup an activation request</div>
            </div>

            <form action="{{$url->make("activate.resend")}}" method="post" class="tld-form" id="activation-form">
                <div class="form-row">
                    <div class="col-sm-12 mx-3">
                        <label for="email">Email</label>
                    </div>
                    <div class="col-sm-12 mx-3">
                        <input type="text" class="form-control tld-input" name="email"
                               value="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-right my-2 mx-3">
                        <button class="g-recaptcha btn btn-primar btn-block tld-button"
                                data-sitekey="6LcklagdAAAAAAb7fXVtUQAdaJMPWk68K_pqztt4"
                                data-callback='onSubmit'
                                data-action='activate'>Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    @endif
@endsection()