@extends("Layouts.backend")

@section("title")
    Account Manager : About
    @endsection

@section("content")
    <div class="container my-3">
        <div class="row px-0 py-2">
            <div class="col-sm-12 px-0  text-center">
                <a href="{{$url->make("account.home")}}">Back to Account home</a>
            </div>
        </div>
    </div>
<div class="container my-3">
    <div class="row">
        <div class="col-md-12">
            <h3 class="alert-dark text-center">
                @isset($error)
                    {{$error}}
                @endisset
            </h3>
        </div>
        <div class="col-sm-12">
            <div class="head">Update About me </div>
            <form class="info" action="{{$url->make("account.about.store")}}" method="post" enctype="multipart/form-data">
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


    {{--    the profile information will show down here.--}}

@endsection