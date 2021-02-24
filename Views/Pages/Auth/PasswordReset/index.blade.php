@extends("Layouts.main")

@section("Content")
    <form action="/auth/reset-password" method="post">
        <input type="email" name="email">
        <button>Reset Password</button>
    </form>
@endsection