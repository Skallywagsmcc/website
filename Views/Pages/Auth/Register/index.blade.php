@extends("Layouts.main")
@section("content")

    <h2>Message : @isset($errmessage){{ $errmessage }}@endisset</h2>
        @if($requirments == true)
            The Password Requirments are as follwes
            1  Upper case letter <br>
            1 lower case letter <br>
            1 number <br>
        @endif

    <div class="container my-2">
        <div class="row my-2 lb3 mx-1">
            <div class="col-sm-12 head text-center text-lg-left pl-lg-2">Create An Account</div>
        </div>
        <form action="{{$url->make("register.store")}}" method="post" class="tld-form">


            <div class="form-row">
                <div class="col-sm-12 mx-3">
                    <label for="username">Username</label>
                </div>
                <div class="col-sm-12 mx-3">
                    <input type="text" class="form-control tld-input" name="username">
                </div>
            </div>

            <div class="form-row">
                <div class="col-sm-12 mx-3">
                    <label for="email">Email</label>
                </div>
                <div class="col-sm-12 mx-3">
                    <input type="text" class="form-control tld-input" name="email">
                </div>
            </div>


            <div class="form-row">
                <div class="col-sm-12 mx-3">
                    <label for="password">password</label>
                </div>
                <div class="col-sm-12 mx-3">
                    <input type="password" class="form-control tld-input" name="password">
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
                    <div class="col-sm-12"><input type="text"  name="first_name" class="form-control tld-input"></div>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <div class="col-sm-12"><label for="last_name">Last Name </label></div>
                    <div class="col-sm-12"><input type="text"  name="last_name" class="form-control tld-input" placeholder=""></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-right my-2 mx-3">
                    <button class="btn tld-button btn-block">Create Account</button>
                </div>
            </div>
        </form>
    </div>

@endsection()