@extends("Layouts.main")

@section("content")
    <div class="container">
        @isset($message)
            <div class="alert-danger my-1 py-1">
                {!! $message !!}
            </div>
        @endisset

        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="col-sm-12">
                    <div class="col-sm-12 head">Reset Your Password</div>
                    <form action="{{$url->make("password-reset.request")}}" method="post" class="tld-form">
                        <label for="email">Email Address</label>
                        <input type="text" name="email" class="form-control tld-input">
                        <button class="btn tld-button btn-block my-2">Reset Password</button>
                    </form>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="col-sm-12 head">Reactivate Login</div>
                <div class="col-sm-12">
                    <form action="{{$url->make("password.cancel.index")}}" method="post" class="tld-form">
                        <label for="email">Email Address</label>
                        <input type="text" name="email" class="form-control tld-input">
                        <button class="btn tld-button btn-block my-2">Reactivate</button>
                    </form>
                </div>
            </div>
        </div>


        <div class="row my-1">
            <div class="col-sm-12 head">
                About Resetting your password
            </div>
        </div>
    </div>
@endsection