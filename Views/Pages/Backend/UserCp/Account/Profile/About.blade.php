@extends("Layouts.Themes.BaseGrey.Account")
@section("title")
    Account Manager : About
@endsection

@section("content")


    <div class="container my-3">
        <div class="row px-0 py-2">
            <div class="col-sm-12 px-0  text-center text-md-left pl-md-1">
                <a href="{{$url->make("account.home")}}">Back to Account home</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 box px-0">
                <div class="head py-2">Edit About Information</div>
            </div>
        </div>
    </div>


    <div class="container my-2">
        <div class="row">
            <div class="col-sm-12 box">
                <form action="{{$url->make("account.about.store")}}" method="post" enctype="multipart/form-data">
                    {{csrf()}}
                    <div class="form-group col-sm-12">
                        <label for="about">About yourself : </label>
                        <textarea name="about" rows="10"
                                  class="form-control">@isset($post){{$post->about}}@else{{$user->Profile->about}}@endisset</textarea>
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



{{--Refactor done on 15/11/2021--}}
@endsection