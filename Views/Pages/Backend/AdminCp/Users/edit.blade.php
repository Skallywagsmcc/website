@extends("Layouts.backend")

@section("title")
@endsection

@section("content")

    @isset($error)
        <div class="container my-2">
            <div class="row box">
                <div class="col-sm-12 head py-2 text-center text-left pl-lg-2">An Error Occurred</div>
                <div class="col-sm-12 text-center py-2 mb-2">{{$error}}</div>
                @isset($required)
                    @foreach($required as $required)
                        <div class="col-sm-12 pl-lg-2 mb-1">
                            {{str_replace("_"," ",$required)}} Required
                        </div>

                    @endforeach
                @endisset
            </div>
        </div>
        @endisset
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
                <form action="{{$url->make("auth.admin.users.update",["id"=>base64_encode($user->id)])}}" method="post" class="tld-form">
                    {{csrf()}}
                    <label for="username">Username (this CANNOT be Changed): </label>
                    <input type="text" class="form-control" name="username"
                           value="@isset($post){{$post->username}}@else{{$user->username}}@endisset">
                    <div class="form-group text-right">
                        <input type="hidden" class="id" name="id" value="@isset($user){{$user->id}}@endisset">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="first_name">First name : </label>
                                <input type="text" class="form-control tld-input" name="first_name" value="@isset($post){{$post->first_name}}@else{{$user->Profile->first_name}}@endisset">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="last_name">Last name : </label>
                                <input type="text" class="form-control tld-input" name="last_name" value="@isset($post){{$post->last_name}}@else{{$user->Profile->last_name}}@endisset">
                            </div>
                        </div>
                        <hr class="bg-light">
                        <label for="email">Email Address : </label>
                        <input type="text" class="form-control tld-input" name="email" value="@isset($post){{$post->email}}@else{{$user->email}}@endisset"
                        <hr>

                        <h2>Other Settings</h2>
                        <label for="is_admin">Set this user as Administrator</label>
                        <input type="checkbox" name="is_admin" @if($user->is_admin == 1) checked @endif value="1">
                        <br>
                        <label for="is_admin">Set this user as Crew Member</label>
                        <input type="checkbox" name="is_crew" @if($user->Profile->is_crew == 1) checked @endif value="1">

                        <div class="row">
                            <div class="col-sm-12">
                                <label for="admin_password">Your User Account password</label>
                            </div>
                            <div class="col-sm-12 my-2 py-2">
                                <input type="password" class="form-control px-1" name="admin_password">
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block">Update User Details</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection