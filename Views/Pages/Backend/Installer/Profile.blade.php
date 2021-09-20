@extends("Layouts.installer")
@section("title")
    Manage Featuured Images
@endsection
@section("content")
    <form action="{{$url->make("installer.profile.store",["key"=>$key])}}" method="post">


        <div class="container">

            <input type="text" name="key" value="{{$key}}">
            <div class="row box mx-2 mx-lg-0 my-2">
                <div class="col-sm-12 head">User Account details</div>
            </div>
            <div class="form-row mx-1 mx-lg-0 my-2 ">
                <div class="col-sm-12 col-lg-6 px-0 mx-0 text-center box my-1 py-2">
                    <div class="col-sm-12 text-left pl-3 pl-0 py-1s"><Label>Username</Label></div>
                    <div class="col-sm-12"><input type="text" class="form-control" name="username"></div>
                </div>

                {{--                Email--}}

                <div class="col-sm-12 col-lg-6 px-0 mx-0 text-center box my-1 py-2">
                    <div class="col-sm-12 text-left pl-3 pl-0 py-1s"><Label>Email Address</Label></div>
                    <div class="col-sm-12 "><input type="email" class="form-control" name="email"></div>
                </div>
            </div>

            <div class="form-group mx-1">
                <div class="row col-sm-12 px-0 mx-0 text-center box my-1 py-2">
                    <div class="col-sm-12 text-left pl-3 pl-0 py-1s"><Label>Password</Label></div>
                    <div class="col-sm-12"><input type="password" class="form-control" name="password"></div>
                </div>
            </div>


            <div class="container my-2">
                <div class="row box">
                    <div class="col-sm-12 head py-2">Profile Information</div>
                </div>
            </div>

            <div class="form-row mx-1 mx-lg-0 my-2 ">
                <div class="col-sm-12 col-lg-6 px-0 mx-0 text-center box my-1 py-2">
                    <div class="col-sm-12 text-left pl-3 pl-0 py-1s"><Label>first Name</Label></div>
                    <div class="col-sm-12"><input type="text" class="form-control" name="first_name"></div>
                </div>

                {{--                Email--}}

                <div class="col-sm-12 col-lg-6 px-0 mx-0 text-center box my-1 py-2">
                    <div class="col-sm-12 text-left pl-3 pl-0 py-1s"><Label>Last Name</Label></div>
                    <div class="col-sm-12 "><input type="text" class="form-control" name="last_name"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <button class="btn btn-block btn-dark">Save and continue</button>
                </div>
            </div>
        </div>
    </form>
@endsection