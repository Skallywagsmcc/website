@extends("Layouts.Themes.BaseGrey.Admin")

@section("title")
    Manage Contact form
@endsection


@section("content")

    @isset($request->error)
        <div class="container-fluid my-2">
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
    <div class="container-fluid my-2">
        <div class="row box">
            <div class="col-sm-12 head py-2">Create A New Resource</div>
        </div>

        <form action="{{$url->make("auth.admin.contact.resources.update",["id"=>base64_encode($request->id)])}}" method="post">
            {{csrf()}}
            @include("Includes.Forms.Resources.edit")

            <div class="row">
                <div class="col-sm-12">
                    <button class="btn btn-block btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>

@endsection