@extends("Layouts.main")


@section("content")
    <div class="row">
        <div class="col-sm-12 col-md-4">

            @include("Includes.AccountNav")
        </div>
        {{--        Side panel--}}
        <div class=".col-sm-12 col-md-8">
            <div class="form-row pt-1 head">
                User Settings page
            </div>
            <form action="{{$url->make("account.settings.store")}}" method="post">
                {{csrf()}}
                <div class="form-row">
                    <div class="form-group col-md-6 text-right">
                        <label for="twofactorauth">Use Two Factor Authentication :</label>
                    </div>

                    <div class="form-group col-md-6 text-center py-1">
                        <input type="checkbox" @if($user->settings->two_factor_auth == 1) checked @endif name="twofactorauth" data-on="Enabled" data-off="Disabled" value="1" data-toggle="toggle" data-offstyle="info">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6 text-right">
                        <label for="email">Display Email Address:</label>
                    </div>
                    <div class="form-group col-md-6 text-center py-1">
                        <input type="checkbox" @if($user->settings->display_email == 1) checked @endif data-on="Visable" data-off="Hidden" name="email" value="1" data-toggle="toggle" data-offstyle="info">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6 text-right">
                        <label for="display_full_name">
                            Allow others to see your full name :
                        </label>
                    </div>
                    <div class="form-group col-md-6 text-center py-1">
                        <input type="checkbox"  data-on="Visable" data-off="Hidden" @if($user->settings->display_full_name == 1)  checked @endif name="fullname" value="1" data-toggle="toggle" data-offstyle="info" >
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6 text-right">
                        <label for="display_full_name">
                            Allows others to see your date of birth :
                        </label>
                    </div>
                    <div class="form-group col-md-6 text-center py-1">
                        <input type="checkbox"  data-on="Visable" data-off="Hidden" @if($user->settings->display_dob == 1) checked @endif name="display_dob" value="1" data-toggle="toggle" data-offstyle="info">
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
@endsection

