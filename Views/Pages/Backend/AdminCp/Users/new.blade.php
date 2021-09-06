@extends("Layouts.backend")

@section("title")
@endsection

@section("content")



    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center text-md-left pl-md-1 py-2">
                <a href="{{$url->make("auth.admin.users.home")}}">Back to User List</a>
            </div>
        </div>
    </div>

    <div class="container box">
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
    </div>

    <div class="container">
        <div class="row box text-center text-md-right pr-md-2 py-2 my-2">
            <div class="col-sm-12 ">Create a new user</div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-sm-12 box py-2">
                <form action="{{$url->make("auth.admin.users.store")}}" method="post" class="tld-form">
                    {{csrf()}}
                    <div class="block">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="first_name">First name : </label>
                                <input type="text" class="form-control tld-input" name="first_name"
                                       value="@isset($user){{$user->first_name}} @endisset">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="last_name">Last name : </label>
                                <input type="text" class="form-control tld-input" name="last_name"
                                       value="@isset($user){{$user->last_name}} @endisset">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6 py-2 prevbtn text-center text-md-left pl-md-1"><a href="#" class="py-2">Previous</a></div>
                            <div class="col-sm-12 col-md-6 py-2 nextbtn text-center text-md-right pr-md-1"><a href="#" class="py-2">next</a></div>
                        </div>

                    </div>

                    <div class="block">
                        <div class="form-row">
                            <label for="email">Email Address : </label>
                            <input type="text" class="form-control tld-input" name="email"
                                   value="@isset($user){{$user->email}} @endisset">

                            <label for="last_name">Username : </label>
                            <input type="text" class="form-control tld-input" name="username"
                                   value="@isset($user){{$user->username}} @endisset">
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 py-2 prevbtn text-center text-md-left pl-md-1"><a href="#" class="py-2">Previous</a></div>
                            <div class="col-sm-12 col-md-6 py-2 nextbtn text-center text-md-right pr-md-1"><a href="#" class="py-2">next</a></div>
                        </div>
                    </div>


                    <div class="block">

                        <div class="form-row">
                            {{--                <div class="form-group col-md-6">--}}
                            {{--                    <label for="first_name">Generate Random Password (tick the checkbox) </label>--}}
                            {{--                    <input type="checkbox" class="form-control tld-input" name="randompw" value="1">--}}
                            {{--                </div>--}}
                            <div class="form-group col-sm-12">
                                <label for="last_name">Create Password </label>
                                <input type="password" class="form-control tld-input" name="password" value="">
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="last_name">Confirm Password </label>
                                <input type="password" class="form-control tld-input" name="confirm-password" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 py-2 prevbtn text-center text-md-left pl-md-1"><a href="#" class="py-2">Previous</a></div>
                            <div class="col-sm-12 col-md-6 py-2 nextbtn text-center text-md-right pr-md-1"><a href="#" class="py-2">next</a></div>
                        </div>
                    </div>


                    <div class="block">
                        <h2>Other Settings</h2>
                        <label for="is_admin">Set this user as Administrator</label>
                        <input type="checkbox" name="is_admin" value="1">

                        <div class="row">
                            <div class="col-sm-12 col-md-6 py-2 prevbtn text-center text-md-left pl-md-1"><a href="#" class="py-2">Previous</a></div>
                            <div class="col-sm-12 col-md-6 py-2 nextbtn text-center text-md-right pr-md-1"><a href="#" class="py-2">next</a></div>
                        </div>
                    </div>


                    <div class="block">
                        <div class="form-group text-right">
                            <button class="btn btn-primary btn-block">Create User</button>
                        </div>
                        <div class="row">
                            <div class="col-sm-12  py-2 nextbtn text-center text-md-right pr-md-1"><a href="#" class="py-2">next</a></div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

