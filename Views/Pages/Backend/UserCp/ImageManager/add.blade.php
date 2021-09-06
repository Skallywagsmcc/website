@extends("Layouts.backend")


@section("title")
    Image Manager : List Images
@endsection

@section("content")


    @isset($message)
        <div class="container my-2">
            <div class="row text-center box">
                <div class="col-sm-12">Error : {{$message}}</div>
            </div>
        </div>
        @endisset()
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center text-md-left pl-md-1"><a href="{{$url->make("images.gallery.home")}}">Back to Images Home</a></div>
        </div>
    </div>


    <div class="container my-2">
        <div class="row box">
            <div class="col-sm-12 head py-2">Upload a new Image</div>
        </div>
    </div>

    <div class="container">
        <div class="row box">
            <div class="col-sm-12">
                <form action="{{$url->make("images.gallery.store")}}" enctype="multipart/form-data" class="tld-form py-2" method="post">
                    {{csrf()}}
                    <div class="form-row">
                        <div class="col-sm-12 text-center text-md-right col-md-6">
                            <label for="title" class="py-2 ">Title  </label>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <input type="text" class="form-control tld-input" name="title" value="@isset($validate){{$validate->Post("title")}}@endisset">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-12 px-0">
                            <label for="description">Description</label>
                        </div>
                        <div class="col-sm-12 px-0">
                            <textarea name="description" class="form-control" rows="10">@isset($validate){{$validate->Post("description")}}@endisset</textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-12 col-md-6 py-2 text-md-right text-center">
                            <label for="ppic">Make this my profile Picture : </label>
                        </div>
                        <div class="col-sm-12 col-md-6 py-2">

                            <input type="checkbox" @isset($validate) @if($validate->Post("ppic") ==1) checked @endif()@endisset() name="ppic" value="1">
                        </div>
                    </div>
                    <input type="file" name="upload" class="my-2">
                    <button class="btn btn-block tld-button">Upload</button>
                </form>
            </div>
        </div>
    </div>

@endsection