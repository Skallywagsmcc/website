@extends("Layouts.main")

@section("title")
    Admin panel Settings
@endsection

@section("content")
    <div class="head">{{$error}}</div>
    <form action="{{$url->make("admin.settings.store")}}" method="post">
        {{csrf()}}
        Allow Comments : <input type="checkbox" name="comments" @if($settings->comments == 1) checked @endif value="1"><br>
        Allow login : <input type="checkbox" name="login" " @if($settings->login == 1) checked @endif value="1"><br>
        Allow Registration : <input type="checkbox" name="registration" " @if($settings->registration == 1) checked @endif value="1"><br>
        Facebook url  : <input type="text" name="facebook" value="{{$settings->facebook}}"><br>
        twitter url  : <input type="text" name="twitter" value="{{$settings->twitter}}"><br>
        discord url  : <input type="text" name="discord" value="{{$settings->discord}}"><br>
        linkin url  : <input type="text" name="linkedin" value="{{$settings->linkedin}}"><hr>
        Email Address   : <input type="text" name="email" value="{{$settings->email}}"><br>
        <label for="password"> Your Password (required)</label><br>
        <input type="password" name="password">

        <button class="btn btn-primary btn-block">Save</button>
    </form>
@endsection