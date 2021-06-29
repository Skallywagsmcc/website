@extends("Layouts.backend")


@section("content")
    <div class="row p-1">
        <div class="col-md-3 col-sm-12">
        </div>
        <div class="col-sm-12 col-md-9">
            <div class="row p-1">
                <div class="col head">
                    Upload a profile picture
                </div>

                <form action="{{$url->make("account.picture.store")}}" method="post" enctype="multipart/form-data">
                    {{csrf()}}
                    <input type="file" name="upload">
                    <button>Upload</button>
                </form>
            </div>
        </div>
    </div>

    {{--    the profile information will show down here.--}}

@endsection