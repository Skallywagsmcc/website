@extends("Layouts.backend")

@section("title")
    Security : Home
@endsection

@section("content")
    <div class="container my-3">
        <div class="row px-0 py-2">
            <div class="col-sm-12 px-0  text-center text-md-left pl-md-1">
                <a href="{{$url->make("account.home")}}">Back to Account home</a>
            </div>
        </div>
    </div>
    <div class="container my-2">
        <div class="row box">
            <div class="col-sm-12 head py-2">Update Account Settings</div>
        </div>
    </div>
    <div class="container my-1">
        <div class="row box px-0">
            <div class="col-sm-12 px-2 py-2">
                <form action="{{$url->make("account.settings.store")}}" method="post">
                    {{csrf()}}
                    <div class="form-row">
                        <div class="form-group col-md-6 text-right">
                            <label for="twofactorauth">Use Two Factor Authentication :</label>
                        </div>

                        <div class="form-group col-md-6 text-center py-1">
                            <input type="checkbox" @if($user->settings->two_factor_auth == 1) checked
                                   @endif name="twofactorauth" data-on="Enabled" data-off="Disabled" value="1"
                                   data-toggle="toggle" data-offstyle="info">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6 text-right">
                            <label for="email">Display Email Address:</label>
                        </div>
                        <div class="form-group col-md-6 text-center py-1">
                            <input type="checkbox" @if($user->settings->display_email == 1) checked
                                   @endif data-on="Visable" data-off="Hidden" name="email" value="1"
                                   data-toggle="toggle" data-offstyle="info">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6 text-right">
                            <label for="display_full_name">
                                Allow others to see your full name :
                            </label>
                        </div>
                        <div class="form-group col-md-6 text-center py-1">
                            <input type="checkbox" data-on="Visable" data-off="Hidden"
                                   @if($user->settings->display_full_name == 1)  checked @endif name="fullname"
                                   value="1" data-toggle="toggle" data-offstyle="info">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6 text-right">
                            <label for="display_full_name">
                                Allows others to see your date of birth :
                            </label>
                        </div>
                        <div class="form-group col-md-6 text-center py-1">
                            <input type="checkbox" data-on="Visable" data-off="Hidden"
                                   @if($user->settings->display_dob == 1) checked @endif name="display_dob" value="1"
                                   data-toggle="toggle" data-offstyle="info">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6 text-right">
                            <label for="display_full_name">
                                Where will your page redirect to :
                            </label>
                        </div>
                        <div class="form-group col-md-6 text-center py-1">
                            <select name="redirect" id="redirect">
                                <option value="1">Site Homepage</option>
                                <option value="2">My profile</option>
                                <option value="3">My Account</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group text-right col-sm-12">
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>

@endsection

