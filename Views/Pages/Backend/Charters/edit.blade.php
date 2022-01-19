@extends("Layouts.Themes.BaseGrey.Admin")
@section("title")
    Charters
@endsection


@section("content")


    <div class="container my-2">
        <div class="row box">
            <div class="col-sm-12 col-lg-9">
                <div class="col-sm-12 head py-2">Update Content</div>
                <form action="{{$url->make("auth.admin.charters.update",["id"=>base64_encode($request->id)])}}" method="post" enctype="multipart/form-data">--}}
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

                    <div class="form-group">
                        <button class="btn btn-primary btn-block">Save</button>
                    </div>
                </form>
            </div>
            <div class="cols-m-12 col-lg-3 text-center">
                <div class="col-sm 12 head py-2">Menu</div>
                <div class="col-sm-12 py-2"><a href="#" class="d-block">Update Content</a></div>
                <div class="col-sm-12 py-2"><a href="#" class="d-block">Update Thumbnail Image</a></div>
                <div class="col-sm-12 py-2"><a href="#" class="d-block">Update Cover Image</a></div>
            </div>
        </div>
    </div>




{{--    <div class="container-fluid my-2">--}}
{{--        <div class="row box">--}}
{{--            <div class="col-sm-12 head py-2">Update Thumbnail</div>--}}

{{--            <div class="col-sm-12 m-1 text-center text-lg-right pr-lg-2">--}}
{{--                <input type="file" name="thumb">--}}
{{--            </div>--}}

{{--            <div class="col-sm-12">--}}
{{--                <button class="btn btn-primary btn-block">Update Thumbnail</button>--}}
{{--            </div>--}}


{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="container-fluid my-2">--}}
{{--        <div class="row box">--}}
{{--            <div class="col-sm-12 head py-2">Update Cover Image</div>--}}

{{--            <div class="col-sm-12 m-1 text-center text-lg-right pr-lg-2">--}}
{{--                <input type="file" name="cover">--}}
{{--            </div>--}}

{{--            <div class="col-sm-12">--}}
{{--                <button class="btn btn-primary btn-block">Update Thumbnail</button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}


{{--    <div class="container-fluid my-2">--}}
{{--        <div class="ro boxw">--}}
{{--            <div class="col-sm-12 head py-2">Update Cover Photo</div>--}}
{{--            <input type="file" name="cover">--}}
{{--        </div>--}}
{{--    </div>--}}

@endsection