@extends("Layouts.main")
@section("content")
    <h2>Registration : Enter Your email</h2>
    <div class="row my-2">
        <form id="register" action="/auth/register" method="post">
            {{--    this will read for both username and password--}}
{{--            <input type="text" name="username" placeholder="Username" id="username"><br><br>--}}
            <input type="text" name="email" id="email" placeholder="email address"><br><br>
{{--            <input type="password" id="password" name="password"><br><br>--}}
{{--            <input type="password" id="confirm" name="confirm"><br>--}}
{{--            --}}
            <button id="save">Save</button>
        </form>
    </div>

@endsection("content")