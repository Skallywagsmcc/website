@extends("Layouts.backend")

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
            The following settings are used to both delete and reinstall the dataabase (this is currently set to install new Databases),
                <br><br>
                Continuing with this process can cause issues within the site, if you have made any changes to the Database Migration files, without any modifications this file should contiune to work as normal

                Please Enter Your Admin password Below.
            </div>
        </div>
        <div class="row my-2 box my-2">
            <div class="col-sm-12 head py-2 pl-lg-1 text-center text-lg-left">Please Enter your password</div>
            <div class="col-sm-12 ">
                <form action="{{$url->make("auth.admin.settings.database.store")}}" method="post">
                    <input type="password" class="form-control my-2" name="password">
                    <button class="btn btn-primary btn-block my-2">Save</button>
                </form>
            </div>
        </div>

    </div>

@endsection