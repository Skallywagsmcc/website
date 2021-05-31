@extends("Layouts.main")

@section("content")
    <div class="container">
        @isset($message)
            <div class="alert-danger my-1 py-1">
                    {!! $message !!}
            </div>
        @endisset
        <form action="{{$url->make("password-reset.request")}}" method="post">
            Email Address : <input type="email" name="email">
            <button class="btn btn-primary btn-block">Send Request</button>
        </form>
    </div>

@endsection