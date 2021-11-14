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
            @isset($error)
            {{$error}}
            @isset($required)
                @foreach($required as $required)
                    {{$required}}
                    @endforeach
                    @endif
            @endisset

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
                    @if($status == true)
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="first_name">First name : </label>
                                <input type="text" class="form-control tld-input" name="first_name"
                                       value="@isset($post){{$post->first_name}} @endisset">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="last_name">Last name : </label>
                                <input type="text" class="form-control tld-input" name="last_name"
                                       value="@isset($post){{$post->last_name}} @endisset">
                            </div>
                    </div>
                    @endif
                    <div class="form-row">
                            <label for="email">Email Address : </label>
                            <input type="text" class="form-control tld-input" name="email"
                                   value="@isset($post){{$post->email}}@endisset"
                        @if($status == true)
                            <label for="last_name">Username : </label>
                            <input type="text" class="form-control tld-input" name="username"
                                   value="@isset($post){{$post->username}}@endisset"/>
                        @endif
                        </div>



                    @if($status == true)
                        <div class="form-row">
                            {{--                <div class="form-group col-md-6">--}}
                            {{--                    <label for="first_name">Generate Random Password (tick the checkbox) </label>--}}
                            {{--                    <input type="checkbox" class="form-control tld-input" name="randompw" value="1">--}}
                            {{--                </div>--}}
                            <div class="form-group col-sm-12">
                                <label for="last_name">Create Password </label>
                                <input type="password" class="form-control tld-input" name="password">
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="last_name">Confirm Password </label>
                                <input type="password" class="form-control tld-input" name="confirm" value="">
                            </div>
                        </div>




                    <div class="row">
                        <div class="col-sm-12">
                            <h2>Other Settings</h2>
                            <label for="is_admin">Set this user as Administrator</label>
                        </div>
                        <div class="col-sm-12">
                            <input type="checkbox" name="is_admin" value="1">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <h2>Other Settings</h2>
                            <label for="is_admin">Set this user as Crew Member</label>
                        </div>
                        <div class="col-sm-12">
                            <input type="checkbox" name="is_crew" value="1">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <label for="admin_password">Your Admin Password</label>
                        </div>
                        <div class="col-sm-12 my-2 py-2">
                            <input type="password" class="form-control px-1" name="admin_password">
                        </div>
                    </div>

                    @endif

                        <div class="form-group text-right">
                            <button class="btn btn-primary btn-block">Create User</button>
                        </div>

                </form>
            </div>
        </div>
    </div>
@endsection

