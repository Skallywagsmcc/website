@extends("Layouts.backend")
@section("title")
    Manage Featuured Images
@endsection
@section("content")
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center text-md-left pl-md-1 py-2">
                <a href="{{$url->make("auth.admin.home")}}">Back to admin home</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row my-2 box">
            <div class="col-sm-12  py-2 my-1">
                We have found ({{$featured->count()}}) Requests
            </div>
        </div>
        <div class="row">
            @foreach($featured as $image)
                <div class="col-sm-12 col-md-4">
                    <div class="col-sm-12 px-0 box text-center">
                        <div class="col-sm-12 head">
                            {{$image->Image->title}}

                             Status : (@if($image->status == 0)
                                Rejected
                            @elseif($image->status == 1)
                                Pending
                            @elseif($image->status == 2)
                                Approved
                            @endif )
                        </div>
                        <div class="col sm-12 px-0 my-1">
                            <img src="/img/uploads/{{$image->Image->name}}" height="200" width="200" alt="">
                        </div>
                        <div class="col-sm-12">
                            <a href="{{$url->make("auth.admin.featured.review",["id"=>base64_encode($image->id)])}}">Manage Request </a>
                        </div>
                    </div>


                </div>
            @endforeach
        </div>
        {!! $links !!}
    </div>

@endsection