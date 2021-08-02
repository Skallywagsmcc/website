@extends("Layouts.backend")

@section("title")
@endsection

@section("content")

    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center text-md-left pl-md-2"><a href="{{$url->make("auth.admin.users.home")}}">Back to users list</a></div>
        </div>
    </div>

    <div class="container my-1">
        <div class="row box">
            <div class="col-md-12 head">Edit User Information for
                : {{$user->Profile->first_name}} {{ $user->Profile->last_name}}</div>
        </div>
    </div>

    <div class="container my-1">
        <div class="row box">
            <div class="col-sm-12 py-2">
                <form action="{{$url->make("auth.admin.users.update")}}" method="post" class="tld-form">
                    {{csrf()}}
                    <label for="username">Username (this CANNOT be Changed): </label>
                    <input type="text" class="form-control-plaintext text-white" readonly name="username"
                           value="@isset($user){{$user->username}}@endisset">
                    <div class="form-group text-right">
                        <input type="hidden" class="id" name="id" value="{{$user->id}}">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="first_name">First name : </label>
                                <input type="text" class="form-control tld-input" name="first_name" value="@isset($user){{$user->Profile->first_name}}@endisset">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="last_name">Last name : </label>
                                <input type="text" class="form-control tld-input" name="last_name" value="@isset($user){{$user->Profile->last_name}}@endisset">
                            </div>
                        </div>
                        <hr class="bg-light">
                        <label for="email">Email Address : </label>
                        <input type="text" class="form-control tld-input" name="email" value="@isset($user){{$user->email}}@endisset">
                        <hr>

                        <h2>Other Settings</h2>
                        <label for="is_admin">Set this user as Administrator</label>
                        <input type="checkbox" name="is_admin" @if($user->is_admin == 1) checked @endif value="1">

                        <button class="btn btn-primary btn-block">Update User Details</button>
                    </div>


                </form>
            </div>
        </div>
    </div>

@endsection