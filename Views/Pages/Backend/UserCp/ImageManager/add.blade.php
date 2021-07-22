@extends("Layouts.backend")


@section("title")
    Image Manager : List Images
@endsection

@section("content")
    <div class="container my-3">

        <div class="row my-3">
            <div class="col-sm-12">
                <a href="{{$url->make("images.gallery.home")}}">Back to images Manager</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 px-0 px-md-2">
                <div class="head py-2">Image Manager Upload Images</div>
                <div class="info px-1 text-center text-md-left">
{{--                    Rules for images gors here --}}
                </div>
            </div>

            <div class="col-sm-12 px-0 px-md-2 my-2">
                <div class="head">Upload Images</div>

                <form action="{{$url->make("images.gallery.store")}}" enctype="multipart/form-data" class="info  tld-form p-2" method="post">
                    <div class="form-row">
                        <div class="col-sm-12 text-left text-md-right col-md-6">
                            <label for="title" class="py-2 ">Title : </label>
                        </div>
                    <div class="col-sm-12 col-md-6">
                        <input type="text" class="form-control tld-input" name="title">
                    </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-12 px-0">
                            <label for="description">Description</label>
                        </div>
                        <div class="col-sm-12 px-0">
                            <textarea name="description" class="form-control" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="form row">
                        <div class="col-sm-12 col-md-6 py-2 text-md-right text-center">
                            <label for="ppic">Make this my profile Picture : </label>
                        </div>
                        <div class="col-sm-12 col-md-6 py-2">
                            <input type="checkbox" name="ppic" value="1">
                        </div>
                    </div>
                    <input type="file" name="upload" class="my-2">
                    <button class="btn btn-block tld-button">Upload</button>
                </form>

            </div>
        </div>
    </div>

@endsection