@extends("Layouts.Themes.BaseGrey.Admin")

@section("title")
    Charters
@endsection


@section("content")


    <div class="container-fluid my-2">
        <div class="row box">
            <div class="col-sm-12 head py-2">An Error occurred</div>
            {{$request->error}}
        </div>
    </div>

    <div class="container-fluid my-2">
        <div class="row box">
            <div class="col-sm-12 head py-2">Add a New Charter</div>
        </div>
    </div>

    <form action="{{$url->make("auth.admin.charters.store")}}" method="post" enctype="multipart/form-data">
        <div class="container my-2">
            {{csrf()}}
            <div class="row">
                <div class="col-sm-12 col-lg-9">
                    <div class="row px-0 mx-0 my-2 box">
                        <div class="col-sm-12">
                            <label for="title">Charter Name</label>
                            <input type="text" name="title" class="form-control tld-input" @isset($request->title)value="{{$request->title}}"@endisset>
                        </div>
                    </div>

                    <div class="row px-0 mx-0 my-2 box">
                        <div class="col-sm-12">
                            <label for="content">Information about the charter</label>
                            <textarea name="content" id="" cols="30" rows="10"
                                      class="form-control tld-input">@isset($request->content){{$request->content}}@endisset</textarea>

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="url">Charter Url</label>
                        <div class="col-sm-12">
                            <input type="url" name="url" @isset($request->url)value="{{$request->url}}"@endisset placeholder="url to charter group">
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-3">


                    <div class="row px-0 mx-0 my-2 box">
                        <div class="col-sm-12 head">Add a thumbnail
                        </div>
                        <div class="col-sm-12">
                            <input type="file"  name="thumb">
                        </div>
                    </div>


                    <div class="row px-0 mx-0 my-2 box">
                        <div class="col-sm-12 head">Add a cover image
                        </div>
                        <div class="col-sm-12 text-center">
                            <input type="file" name="cover">
                        </div>
                    </div>

                    <div class="row px-0 mx-0 my-2 box">
                        <button class="btn tld-button  btn-primary btn-block">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection