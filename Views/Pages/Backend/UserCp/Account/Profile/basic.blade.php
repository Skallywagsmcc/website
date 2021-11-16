@extends("Layouts.backend")
@section("title")
Account Manager : Basic Informatiomn
@endsection

@section("content")
    <div class="container my-3">
        <div class="row px-0 py-2">
            <div class="col-sm-12 px-0  text-center">
                <a href="{{$url->make("account.home")}}">Back to Account home</a>
            </div>
        </div>
    </div>

    @include("Includes.Backend.Error")

    <div class="container my-1">
        <div class="row box">
            <div class="col-sm-12 head py-2">Edit Basic Information</div>
        </div>
    </div>

<div class="container my-2">
    <div class="row">
        <div class="col-md-12 px-0 px-md-1 box py-2">
            <form action="{{$url->make("account.basic.store")}}" method="post">
{{--                     check csrf--}}
                {{csrf()}}
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="first_name">First name : </label>
                        <input type="text" class="form-control" name="first_name"
                               value="@isset($post){{$post->first_name}}@else{{$user->Profile->first_name}}@endisset">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="last_name">Last name : </label>
                        <input type="text" class="form-control" name="last_name"
                               value="@isset($post){{$post->last_name}}@else{{$user->Profile->last_name}}@endisset">
                    </div>
                </div>

                <div class="form-group col-sm-12">
                    <label for="dob">Date of birth </label>
                    @isset($user)
                    {{$user->Profile->dob}}
                    @endisset
                    <input type="date" class="form-control" name="dob">
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

{{--  Refactor Complete on 15/11/2021--}}

@endsection