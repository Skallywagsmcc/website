@extends("Layouts.main")

@section("title")
    Verify : Your two factor Auth
@endsection

@section("content")
    @isset($errormessage)
        <div class="alert-dark">{{$errormessage}}</div>
    @endisset
    <div class="row">
        <div class="col-sm-12 head">Enter Your Code</div>
        <div class="col-sm-12 text-center">
            Please click the Request Code Button below and we will send and email to your request email address
            ( {{$user->email}} )
            <br>
            Once submitted this request will last for 15 minutes, after this a new request will need to be made
        </div>
    </div>
    <div class="col-sm-12">
        <form action="{{$url->make("tfa.save")}}" method="post">
            <input type="text" name="code" class="form-control my-2" value="{{$tfa->code}}">
            <button class="btn btn-block btn-secondary text-white">Request Code</button>
        </form>
    </div>

@endsection