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
                    <div class="col-sm-12 head">Reset Your Passwrod Password</div>
                    <form action="{{$url->make("password-reset.request")}}" method="post">
                        <label for="email">Email Address</label>
                        <input type="text" name="email" class="form-control">
                        <button class="btn btn-primary btn-block my-2">Reset Password</button>
                    </form>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="col-sm-12 head">Reactivate Login</div>
                <div class="col-sm-12">
                    <form action="{{$url->make("password.cancel.index")}}" method="post">
                        <label for="email">Email Address</label>
                        <input type="text" name="email" class="form-control">
                        <button class="btn btn-primary btn-block my-2">Reactivate</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection