@extends("Layouts.backend")


@section("title")
    Image Manager : Manage Image
@endsection

@section("content")
    <div class="container my-2">

        <div class="row">

            <div class="col-sm-12 text-center">
                <a href="{{$url->make("images.gallery.home")}}">Back to images Manager</a>
            </div>
        </div>

    </div>

    <div class="container my-2">
        <div class="row box">
            <div class="col-sm-12 head py-2 text-center text-md-left pl-md-1">Manage Image : {{$image->title}}</div>
        </div>
    </div>

    <div class="container my-2">
        <div class="row">
            <div class="col-sm-12 p-2 d-md-flex justify-content-sm-center">
                <img src="/img/uploads/{{$image->name}}" alt="{{$image->title}}" class="img-fluid">
            </div>
        </div>

        <div class="row box my-2">
            <div class="col-sm-12 py-2 text-center"><a
                        href="{{$url->make("images.gallery.delete",["id"=>base64_encode($image->id)])}}"
                        class="d-block">Delete image</a></div>
        </div>

        <div class="row box my-2">
            <div class="col-sm-12 head py-2 text-center text-md-left pl-md-1">Featured Image Requests</div>
        </div>

        <div class="row box">
            <div class="col-sm-12 p-2">A featured Request allows you as a user to submit your photos to be placed on the
                front page of the site, allowing interaction between yourself and visitors,
                <br><br> Use the options below to manage your request for this image
            </div>
        </div>

        <div class="row box my-2">
            @if($image->count_featured($image->id) == 0)
                <div class="col-sm-12 col-md-6 py-2 text-center">Current Status Not submitted</div>
                <div class="col-sm-6 py-2 text-center">
                    <a href="{{$url->make("images.featured.add",["id"=>base64_encode($image->id)])}}" class="d-block">Submit
                        to be featured</a></div>

            @else
            @if($image->fstatus($image->id) == 1)
                <div class="col-sm-12 col-md-6 py-2 text-center">Current Status Pending</div>
                <div class="col-sm-12 col-md-6 py-2 text-center"><a
                            href="{{$url->make("images.featured.delete",["id"=>base64_encode($image->Featured->id)])}}"
                            class="d-block">Cancel Request</a></div>

            @elseif($image->fstatus($image->id) == 0)
                <div class="col-sm-12 col-md-6 py-2 text-center">Current Status Rejected</div>
                <div class="col-sm-12 col-md-6 py-2 text-center"><a
                            href="{{$url->make("images.featured.home",["id"=>base64_encode($image->id)])}}"
                            class="d-block">Learn why?</div>
            @elseif($image->fstatus($image->id) == 2)
                <div class="col-sm-12 col-md-6 py-2 text-center">Current Status Approved</div>
                <div class="col-sm-12 col-md-6 py-2 text-center">
                    {{$image->Featured->id}}<a
                            href="{{$url->make("images.featured.delete",["id"=>base64_encode($image->Featured->id)])}}"
                            class="d-block">Delete Request</div>
            @else

            @endif
            @endif
        </div>


    </div>


@endsection