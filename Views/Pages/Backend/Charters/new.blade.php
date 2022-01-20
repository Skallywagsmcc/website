@extends("Layouts.Themes.BaseGrey.Admin")

@section("title")
    Charters
@endsection


@section("content")


    @isset($request->error)
        <div class="container-fluid my-2">
            <div class="row box">
                <div class="col-sm-12 head py-2">An Error occurred</div>
                {{$request->error}}
                @isset($request->required)
                    <div class="col-sm-12">MIssing fields</div>
                    @foreach($request->required as $required)
                        {{$required}}
                    @endforeach
                @endisset
            </div>
        </div>
    @endisset
    <div class="container-fluid my-2">
        <div class="row box">
            <div class="col-sm-12 head py-2">Add a New Charter</div>
        </div>
    </div>

    <form action="{{$url->make("auth.admin.charters.store")}}" method="post" enctype="multipart/form-data">
        <div class="container my-2">
            {{csrf()}}
            <div class="row">
                <div class="col-sm-12 col-lg-8">
                    <div class="row px-0 mx-0 my-2 box">
                        <div class="col-sm-12">
                            <label for="title">Charter Name</label>
                            <input type="text" name="title" class="form-control tld-input"
                                   @isset($request->title)value="{{$request->title}}"@endisset>
                        </div>
                    </div>

                    <div class="row px-0 mx-0 my-2 box">
                        <div class="col-sm-12">
                            <label for="content">Information about the charter</label>
                            <textarea name="content" id="" cols="30" rows="10"
                                      class="form-control tld-input">@isset($request->content){{$request->content}}@endisset</textarea>

                        </div>
                    </div>
                    {{--                    Add Resources Button Here use jquery to add value --}}

                </div>
                <div class="col-sm-12 col-lg-4">


                    <div class="row px-0 mx-0 my-2 box">
                        <div class="col-sm-12 head">Add a thumbnail
                        </div>
                        <div class="col-sm-12 my-1">
                            <input type="file" name="thumb">
                        </div>
                    </div>

                    <div class="row px-0 mx-0 my-2 box">
                        <div class="col-sm-12 head">Add Cover Image (Optional)</div>
                        <div class="col-sm-12 my-1">
                            <input type="file" name="cover">
                        </div>
                    </div>

                    <div class="row px-0 mx-0 my-2 box">
                        <button class="btn tld-button  btn-primary btn-block">Save and Continue</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection