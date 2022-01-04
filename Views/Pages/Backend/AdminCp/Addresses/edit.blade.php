@extends("Layouts.Themes.BaseGrey.Admin")

@section("title")
    {{APP_NAME}} Admin panel Addresses
@endsection

@section("content")


    @isset($request->error)
        <div class="container my-2">
            <div class="row box">
                <div class="col-sm-12 head py-2 text-center text-lg-left pl-lg-2">An Error Occurred</div>
                <div class="col-sm-12 text-center">{{$request->error}}</div>
                <div class="col-sm-12.pl-lg-2 text-center text-lg-left">
                    @isset($request->required)
                        @foreach($request->required as $required)
                            <strong class="p-2 tu my-2">{{$required}}</strong>
                        @endforeach
                    @endisset
                </div>
            </div>
        </div>
    @endisset
    <div class="container">
        @if($request->showform==true)
        <div class="row box my-2">
            <div class="col-sm-12 text-center text-lg-left head pl-lg-2">Update Address</div>
        </div>

        <form action="{{$url->make("auth.admin.addresses.update",["id"=>base64_encode($request->id)])}}" method="post">
            {{csrf()}}

     @include("Includes.Forms.Addresses.edit")

            <div class="row  my-2 p-2">
                <div class="col-sm-12">
                    <button class="btn btn-block btn-primary">Update Address and continue</button>
                </div>
            </div>


        </form>

    </div>
    @endif
@endsection