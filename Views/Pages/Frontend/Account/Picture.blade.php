@extends("Layouts.main")


@section("content")
    <div class="row p-1">
        <div class="col-md-3 col-sm-12">
            @include("Includes.AccountNav")
        </div>
        <div class="col-sm-12 col-md-9">
            <div class="row p-1">
                <div class="col head">
                    Upload a profile picture
                </div>

                <form action="/account/edit/picture" method="post" enctype="multipart/form-data">
                    <input type="file" name="upload">
                    <button>Upload</button>
                </form>
    </div>

    {{--    the profile information will show down here.--}}

@endsection