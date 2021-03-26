@extends("Layouts.main")


@section("content")
    <div class="row p-1">
        <div class="col-md-3 col-sm-12">
            @include("Includes.AccountNav")
        </div>
        <div class="col-sm-12 col-md-9">
            <div class="row p-1">

                <div class="col head">
                    About you.
                </div>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <h3 class="alert-dark text-center">
                        @isset($error)
                            {{$error}}
                        @endisset
                    </h3>

                    <form action="/account/edit/about" method="post" enctype="multipart/form-data">
                        <div class="form-group col-sm-12">
                            <label for="about">About yourself : </label>
                            <textarea name="about" rows="10" class="form-control">{{$user->Profile->about}}</textarea>
                        </div>
                        <input type="file" name="upload">
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