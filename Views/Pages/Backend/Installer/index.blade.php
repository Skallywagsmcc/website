@extends("Layouts.installer")
@section("title")
    Manage Featuured Images
@endsection
@section("content")

    @isset($error)
        <div class="container my-2">
            <div class="row box mx-1 mx-lg-0 py-2 text-center">
                <div class="col-sm-12">{{$error}}</div>
            </div>
        </div>

    @endisset

    <form action="{{$url->make("installer.terms.store",["key"=>$key])}}" method="post">

        <div class="container my-2">
            <div class="row"><div class="col-sm-12"><input type="text" name="key" value="{{$key}}"></div></div>
        </div>
        <div class="container my-2">
            <div class="row mx-1 mx-lg-0 box">
                <div class="col-sm-12 head py-2 text-center text-lg-left pl-lg-2">Terms and conditions</div>
            </div>

            <div class="row box mx-1 mx-lg-0 my-2 py-2">
                <div class="col-sm-12 text-center">The Terms and conditions will go Here</div>
            </div>
        </div>

        <div class="container my-2">
            <div class="row mx-1 mx-lg-0">
                <div class="col-sm-12 text-center box text-lg-right pr-lg-2 py-2">I agree to the terms and conditions : <input type="checkbox" name="accept" value="1"></div>
            </div>
        </div>

        <div class="container my-2">
            <div class="row mx-lg-0">
                <div class="col-sm-12"><button class="btn btn-block btn-dark">Start Setup</button></div>
            </div>
        </div>
    </form>
@endsection