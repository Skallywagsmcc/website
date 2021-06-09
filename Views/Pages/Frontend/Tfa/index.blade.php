@extends("Layouts.main")

@section("title")
    Verify : Your two factor Auth
@endsection

@section("content")
    <div class="row">
        <div class="col-sm-12 head">Request a Login Code</div>
        <div class="col-sm-12 text-center">
            Please click the Request Code Button below and we will send and email to your request email address ( {{$user->email}} )
            <br>
            Once submitted this request will last for 15 minutes, after this a new request will need to be made
        </div>
    </div>
    <div class="col-sm-12">
        <form action="{{$url->make("tfa.get")}}" method="post">
            {{csrf()}}
            <input type="hidden" readonly required name="email" value="{{$user->email}}">
            <button class="btn btn-block btn-primary text-white">Request Code</button>
        </form>
    </div>



@endsection