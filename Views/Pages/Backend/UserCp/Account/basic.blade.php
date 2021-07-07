@extends("Layouts.backend")


@section("content")
    <div class="container-fluid">
        <div class="row ">
            @include("Includes.Backend.ProfileSidebar")
            <div class="col-sm-12 col-md-10">
                <div class="row">
                    <div class="col head">
                        Your Profile
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @isset($error)
                            <div class="alert-dark text-center">{{$error}}</div>
                        @endisset
                        @isset($values)

                            @foreach($values as $data)
                                <ul>
                                    <li>
                                        {{ $data }}
                                    </li>
                                </ul>
                            @endforeach
                        @endisset

                        <form action="{{$url->make("account.basic.store")}}" method="post">
                            {{csrf()}}
                            <div class="form-group col-md-6">
                                <label for="first_name">Your username : </label>
                                <input type="text" class="form-control-plaintext text-white" readonly name="username"
                                       value="@isset($user){{$user->username}}@endisset">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="first_name">First name : </label>
                                    <input type="text" class="form-control" name="first_name"
                                           value="@isset($user){{$user->Profile->first_name}}@endisset">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="last_name">Last name : </label>
                                    <input type="text" class="form-control" name="last_name"
                                           value="@isset($user){{$user->Profile->last_name}} @endisset">
                                </div>
                            </div>

                            <div class="form-group col-sm-12">
                                <label for="dob">Date of birth </label>
                                <input type="date" class="form-control" name="dob" value="@isset($user){{$user->profile->dob}}@endisset">
                            </div>

                            <div class="form-group col-sm-12">
                                <label for="password">Enter Your Password (this is required) </label>
                                <input type="password" class="form-control" name="password">
                            </div>

                            <div class="form-group col-sm-12 text-right">
                                <button class="btn btn-primary">Save</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>


    {{--    the profile information will show down here.--}}

@endsection