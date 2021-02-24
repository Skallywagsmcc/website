@extends("Layouts.main")
@section("content")
    <h2>Registration : Enter Your email</h2>
    <div>
        This registration form will allow you to create a new account you will be directed to the new password screen after
        <br>
        you will have 15 minutes to create your account before the request expires
        <br>
        even though the request is expired you will have 7 days in order to do a <a href="/auth/reset-password">Password Reset</a>
        <br>
        After 7 Days your Registration request will be deleted
    </div>
    <div class="row my-2">
        <form id="register" action="/auth/register" method="post">
            <input type="text" name="email" id="email" placeholder="email address"><br><br>
            <input type="password" name="password" id="password"><br><br>
            <button id="save">Register Account</button>
        </form>
    </div>

@endsection("content")