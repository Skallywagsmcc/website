@extends("Layouts.main")

@section("content")
    <form action="/auth/reset-password" method="post">
        <input type="email" name="email">
        <button>Send Request</button>
    </form>
@endsection