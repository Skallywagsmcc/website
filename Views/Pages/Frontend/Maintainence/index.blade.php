@extends("Layouts.Auth")

@section("title")
    Maintainence Mode
@endsection

@section("content")
    <div class="row h-100 mx-0 px-0">
        <div class="col-sm-12 d-flex my-auto justify-content-center">
            <div class="w-25 d-md-block d-none">
                @include("Includes.Frontend.maintainence")
            </div>

            <div  class="w-75 d-md-none d-block">
                @include("Includes.Frontend.maintainence")
            </div>
        </div>
    </div>
    @endsection()