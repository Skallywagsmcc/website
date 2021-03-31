@extends("Layouts.main")

@section("title")
@endsection

@section("content")
    <div class="row">
        <div class="col-md-12 head">Edit User Information for
            : {{$user->Profile->first_name}} {{ $user->Profile->last_name}}</div>
    </div>
    <form action="{{$url->make("admin.users.update")}}" method="post">
{{csrf()}}
        <label for="last_name">Username (this CANNOT be Changed): </label>
        <input type="text" class="form-control-plaintext text-white" readonly name="username"
               value="{{$user->username}}">
        <div class="form-group text-right">
            <input type="hidden" class="id" name="id" value="{{$user->id}}">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="first_name">First name : </label>
                    <input type="text" class="form-control" name="first_name" value="{{$user->Profile->first_name}}">
                </div>
                <div class="form-group col-md-6">
                    <label for="last_name">Last name : </label>
                    <input type="text" class="form-control" name="last_name" value="{{$user->Profile->last_name}}">
                </div>
            </div>
            <hr class="bg-light">
            <label for="email">Email Address : </label>
            <input type="text" class="form-control" name="email" value="{{$user->email}}">
            <br>
            <button class="btn btn-primary">Update User Details</button>
        </div>
        <div class="col-sm-12 head">User Preferences</div>
        @if($user->settings_count == 1)
            <div class="form-row">
                <div class="col-md-6 text-right">
                    <label for="two_factor_auth" class="form-check-label">Use Two Factor Authentication</label>
                </div>
                <div class="col-md-6 py-2">
                    <input type="checkbox" name="two_factor_auth"
                           @if($user->settings->two_factor_auth == 1) checked="checked"
                           @endif class="form-check">
                </div>
            </div>

            <div class="form-row ">
                <div class="col-md-6 text-right">
                    <label for="two_factor_auth" class="form-check-label">Email marketing</label>
                </div>
                <div class="col-md-6 py-2">
                    <input type="checkbox" name="two_factor_auth" class="form-check">
                </div>
            </div>
        @else
            no settings table found
        @endif


    </form>
@endsection