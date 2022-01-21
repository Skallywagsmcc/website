@extends("Layouts.Themes.BaseGrey.Admin")
@section("title")
    Charters
@endsection


@section("content")

    @isset($request->error)
        <div class="container-fluid my-2">
            <div class="row">
                <div class="col-sm-12">
                    {{$request->error}}
                </div>
            </div>
        </div>
    @endisset

    <form action="{{$url->make("auth.admin.charters.update",["id"=>base64_encode($request->id)])}}" method="post"
          enctype="multipart/form-data">
        <div class="container-fluid my-2">
            <div class="row box">
                <div class="col-sm-12 col-lg-8">
                    <div class="col-sm-12 head py-2">Update Charter</div>
                    {{csrf()}}
                    <input type="hidden" name='id' value="{{$request->charter->id}}">
                    <div class="form-group">
                        <label for="title">Charter Name</label>
                        <input type="text" name="title" class="form-control" value="{{$request->charter->title}}">
                    </div>
                    <div class="form-group">
                        <label for="content">Information about the charter</label>
                        <textarea name="content" id="" cols="30" rows="10"
                                  class="form-control">{{$request->charter->content}}</textarea>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-4 text-center">
                    <div class="row px-0 mx-0 my-2 box">
                        <div class="col-sm-12 head mt-2">Add a thumbnail
                        </div>
                        <div class="col-sm-12">
                            <input type="file" name="thumb">
                        </div>
                    </div>

                    <div class="row px-0 mx-0 my-2 box">
                        <div class="col-sm-12 head">Add a Cover image
                        </div>
                        <div class="col-sm-12">
                            <input type="file" name="cover">
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block">Update charter</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @endsection