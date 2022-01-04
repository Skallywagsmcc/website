@extends("Layouts.Themes.BaseGrey.Admin")


@section("title")
    Admin Panel : Database Reinstall
@endsection

@section("content")

    @isset($error)
        <div class="container my-2">
            <div class="row box">
                <div class="col-sm-12 head py-2 text-center text-lg-left pl-lg-2">An Error Occurred</div>
                <div class="col-sm-12 text-center py-2">{{$error}}</div>
            </div>
        </div>
    @endisset


    <div class="container my-2">
        <div class="row box">
            <div class="col-sm-12 head py-2 text-center text-lg-left pl-lg-1">Database Reinstallation Setup</div>
            <div class="col-sm-12 text-center"><h2>Please Read below</h2>
                This Section of the website, can be destructive and must only be used in events that your database is
                corrupt or needs some modification which require a table rebuild.
                <h4>Please make sure you know what you are doing</h4>
                <br><br>
                Please do the following
                <br><br>
                <ul>
                    <li>Backup Your data using your database management tool (do not backup the database table itself)
                    </li>
                    <li>Select the specified Migration file you wish to rebuild</li>
                    <li>Submit the rebuild using your admin password</li>
                    <li>Restore your data in your database manager tool</li>
                </ul>
                <br><br>
                As a precautionary measure we have disabled the ability for you to delete the users, Profiles,
                Instalation and Settings Tables to prevent complete user account loses, Please speak to your Web
                Administator to modify these files
            </div>
        </div>

        <div class="row my-2 box">
            <div class="col-sm-12 py-2 text-center head pl-lg-2 text-lg-left">Your installed Database Tables</div>
        </div>

        <form action="{{$url->make("auth.admin.settings.database.store")}}" method="post">
            {{csrf()}}
        <div class="row my-2 box">
            <div class="col-sm-12 py-2 head text-center text-lg-left pl-lg-2">Drop Databases</div>
            <div class="col-sm-12 col-lg-6 py-2 pr-lg-2 text-center text-lg-right">
                <label for="drop">I confirm i want to drop the databases </label>
            </div>
            <div class="col-sm-12 col-lg-6 py-2 text-center">
                <input type="checkbox" name="drop" value="1">
            </div>
        </div>
            <div class="row my-2 box">
                <div class="col-sm-12 head py-2 pl-lg-1 text-center text-lg-left">Please Enter your password</div>
                <input type="password" class="form-control my-2" name="password">
                <button class="btn btn-primary btn-block my-2">Reinstall Database</button>
            </div>
        </form>
    </div>

@endsection