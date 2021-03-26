@extends("Layouts.main")


@section("content")
    <div class="row p-1">
        <div class="col-md-3 col-sm-12">
            @include("Includes.AccountNav")
        </div>
        <div class="col-sm-12 col-md-9">
            <div class="row p-1">
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
                    <form action="/account/edit/basic" method="post">
                        <div class="form-group col-md-6">
                            <label for="first_name">Your username : </label>
                            <input type="text" class="form-control-plaintext text-white" readonly name="username"
                                   value="{{$user->username}}">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="first_name">First name : </label>
                                <input type="text" class="form-control" name="first_name"
                                       value="{{$user->Profile->first_name}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="last_name">Last name : </label>
                                <input type="text" class="form-control" name="last_name"
                                       value="{{$user->Profile->last_name}}">
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="about">About yourself : </label>
                            <textarea name="about" rows="10" class="form-control">{{$user->Profile->about}}</textarea>
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="dob">Date of birth </label>
                            <input type="date" class="form-control" name="dob" value="{{$user->profile->dob}}">
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

    {{--    the profile information will show down here.--}}

@endsection