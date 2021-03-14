@extends("Layouts.main")

@section("title")
@endsection

@section("content")
    {{--    Create user information--}}
<div class="row">
    <div class="col-md-12 head"> Create a new user</div>
</div>
    <form action="/admin/users/new" method="post">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="first_name">First name : </label>
                <input type="text" class="form-control" name="first_name" value="{{$user->first_name}}">
            </div>
            <div class="form-group col-md-6">
                <label for="last_name">Last name : </label>
                <input type="text" class="form-control" name="last_name" value="{{$user->last_name}}">
            </div>
        </div>
        <hr class="bg-light">

                <label for="email">Email Address : </label>
                <input type="text" class="form-control" name="email" value="{{$user->email}}">

                <label for="last_name">Username : </label>
                <input type="text" class="form-control" name="username" value="{{$user->username}}">
        <hr class="bg-light">

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="first_name">Generate Random Password (tick the checkbox)  </label>
                <input type="checkbox" class="form-control" name="randompw" value="1">
            </div>
            <div class="form-group col-md-6">
                <label for="last_name">Create Custom Password </label>
                <input type="password" class="form-control" name="password" value="">
            </div>
        </div>

        <div class="form-group text-right">
           <button class="btn btn-primary">Create User</button>
        </div>

    </form>
@endsection