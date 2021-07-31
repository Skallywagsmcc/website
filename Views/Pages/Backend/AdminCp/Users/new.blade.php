@extends("Layouts.backend")

@section("title")
@endsection

@section("content")

    <div class="container">
        {{--    Create user information--}}
        <div class="alert-danger">Message :
            @isset($error){{$error}}@endisset
            @isset($values)
                <ol>
                    @foreach($values as $value)
                        <li>
                            Missing : {{$value}}
                        </li>
                    @endforeach
                </ol>
                <hr>
            @endisset()
            @isset($validpw)
                @if($validpw == 1)
                    Sorry the PAssword Requirements do not  match Please use the following
                    <ol>
                        <li>Aleast One Uppercase letter</li>
                        <li>Aleast One Lowercase letter</li>
                        <li>Aleast One Number</li>
                    </ol>


                @else
                    Password is strong
                @endif
            @endisset
        </div>
        <div class="row">
            <div class="col-md-12 head"> Create a new user</div>
        </div>
        <form action="{{$url->make("auth.admin.users.store")}}" method="post" class="tld-form">
            {{csrf()}}
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="first_name">First name : </label>
                    <input type="text" class="form-control tld-input" name="first_name" value="@isset($user){{$user->first_name}} @endisset">
                </div>
                <div class="form-group col-md-6">
                    <label for="last_name">Last name : </label>
                    <input type="text" class="form-control tld-input" name="last_name" value="@isset($user){{$user->last_name}} @endisset">
                </div>
            </div>
            <hr class="bg-light">

            <label for="email">Email Address : </label>
            <input type="text" class="form-control tld-input" name="email" value="@isset($user){{$user->email}} @endisset">

            <label for="last_name">Username : </label>
            <input type="text" class="form-control tld-input" name="username" value="@isset($user){{$user->username}} @endisset">
            <hr class="bg-light">

            <div class="form-row">
{{--                <div class="form-group col-md-6">--}}
{{--                    <label for="first_name">Generate Random Password (tick the checkbox) </label>--}}
{{--                    <input type="checkbox" class="form-control tld-input" name="randompw" value="1">--}}
{{--                </div>--}}
                <div class="form-group col-sm-12">
                    <label for="last_name">Create  Password </label>
                    <input type="password" class="form-control tld-input" name="password" value="">
                </div>
                <div class="form-group col-sm-12">
                    <label for="last_name">Confirm Password </label>
                    <input type="password" class="form-control tld-input" name="confirm-password" value="">
                </div>
            </div>

            <h2>Other Settings</h2>
            <label for="is_admin">Set this user as Administrator</label>
            <input type="checkbox" name="is_admin" value="1">

            <div class="form-group text-right">
                <button class="btn btn-primary">Create User</button>
            </div>

        </form>
    </div>

@endsection