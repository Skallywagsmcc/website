@extends("Layouts.backend")


@section("content")
    <div class="row">
     @include("Includes.Backend.ProfileSidebar")
        <div class="col-sm-12 col-md-9">
            <div class="row p-1 my-2">
                <div class="col-sm-12 head py-2">
                    Edit Mode : About you
                </div>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <h3 class="alert-dark text-center">
                        @isset($error)
                            {{$error}}
                        @endisset
                    </h3>

                    <form action="{{$url->make("account.about.store")}}" method="post" enctype="multipart/form-data">
                        {{csrf()}}
                        <div class="form-group col-sm-12">
                            <label for="about">About yourself : </label>
                            <textarea name="about" rows="10" class="form-control">@isset($user){{$user->Profile->about}}@endisset</textarea>
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