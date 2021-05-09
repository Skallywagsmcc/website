@extends("Layouts.main")

@section("content")
    <div class="container">
        <form action="{{$url->make("password-reset.request")}}" method="post">
            Username : <input type="username" name="username"> <br>
            Email : <input type="email" name="email">
            <button class="btn btn-primary btn-block">Send Request</button>
        </form>
    </div>

@endsection