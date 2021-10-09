@extends("Layouts.installer")
@section("title")
    Manage Featuured Images
@endsection
@section("content")

@isset($error)
    <div class="container my-2">
        <div class="row box mx-1 mx-lg-0 mx-lg-0 text-center">
            <div class="col-sm-12 head">An Error Occurred</div>
            <div class="col-sm-12 py-2">{{$error}}</div>
            <ol class="col-sm-12 text-center text-lg-left">
                @isset($rmf)
                @foreach($rmf as $required)
                    <li>{{$required}}</li>
                @endforeach
                @endisset
            </ol>
        </div>
    </div>
@endisset

    <form action="{{$url->make("installer.profile.store",["key"=>$key])}}" method="post">

        <div class="container">
            <input type="text" name="key" value="{{$key}}">
            <div class="row box mx-1 mx-lg-0 mx-lg-0 my-2">
                <div class="col-sm-12 head py-2">User Account details</div>
            </div>
            <div class="form-row mx-1 mx-lg-0 mx-lg-0 my-2 ">
                <div class="col-sm-12 col-lg-6 px-0 mx-0 text-center box my-1 py-2">
                    <div class="col-sm-12 text-left pl-3 pl-0 py-1s"><Label>Username</Label></div>


                    <div class="col-sm-12"><input type="text" class="form-control" name="username" value="{{$post->username}}"></div>
                </div>

                {{--                Email--}}

                <div class="col-sm-12 col-lg-6 px-0 mx-0 text-center box my-1 py-2">
                    <div class="col-sm-12 text-left pl-3 pl-0 py-1s"><Label>Email Address</Label></div>
                    <div class="col-sm-12 "><input type="text" class="form-control" name="email" value="{{$post->email}}"></div>
                </div>
            </div>

                <div class="row box my-2 mx-1 mx-lg-0">
                    <div class="col-sm-12 head py-2">Create your Password</div>
                </div>


            <div class="form-row mx-1 mx-lg-0">
                <div class="col-sm-12 col-lg-6 px-0 mx-0 text-center box my-1 py-2">
                    <div class="col-sm-12 text-left pl-3 pl-0 py-1s"><Label for="password">Password</Label></div>
                    <div class="col-sm-12"><input type="password" class="form-control" name="password"></div>
                </div>

                <div class="col-sm-12 col-lg-6 px-0 mx-0 text-center box my-1 py-2">
                    <div class="col-sm-12 text-left pl-3 pl-0 py-1s"><Label for="confirm">Confirm password</Label></div>
                    <div class="col-sm-12"><input type="password" class="form-control" name="confirm"></div>
                </div>
            </div>




            <div class="container my-2">
                <div class="row box">
                    <div class="col-sm-12 head py-2">Profile Information</div>
                </div>
            </div>

            <div class="form-row mx-1 mx-lg-0 mx-lg-0 my-2 ">
                <div class="col-sm-12 col-lg-6 px-0 mx-0 text-center box my-1 py-2">
                    <div class="col-sm-12 text-left pl-3 pl-0 py-1s"><Label>first Name</Label></div>
                    <div class="col-sm-12"><input type="text" class="form-control" name="first_name" value="{{$post->first_name}}"></div>
                </div>

                {{--                Email--}}

                <div class="col-sm-12 col-lg-6 px-0 mx-0 text-center box my-1 py-2">
                    <div class="col-sm-12 text-left pl-3 pl-0 py-1s"><Label>Last Name</Label></div>
                    <div class="col-sm-12 "><input type="text" class="form-control" name="last_name" value="{{$post->last_name}}"/></div>
                </div>
            </div>

            <div class="row box mx-1 mx-lg-0">
                <div class="col-sm-12 head py-2">Optional Settings</div>
            </div>

        <div class="form-row my-2 mx-1 mx-lg-0 mx-lg-0 box py-2">
            <div class="col-sm-12 col-lg-6"><label for="open_reg">Allow Public Registration</label></div>
            <div class="col-sm-12 col-lg-6 text-lg-left pl-lg-2"><input type="checkbox" value="1" name="open_reg"></div>
        </div>

            <div class="form-row my-2 mx-1 mx-lg-0 mx-lg-0 box py-2">
            <div class="col-sm-12 col-lg-6"><label for="open_reg">Allow Publc login</label></div>
            <div class="col-sm-12 col-lg-6 text-center text-lg-left pl-lg-2"><input type="checkbox" value="1" name="open_login"></div>
        </div>

            <div class="row">
                <div class="col-sm-12">
                    <button class="btn btn-block btn-dark">Save and continue</button>
                </div>
            </div>
        </div>
    </form>
@endsection