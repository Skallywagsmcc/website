@extends("Layouts.main");
@section("title")
Manage Featuured Images
@endsection
@section("content")
    <div class="container">
        <div class="row head">Pending Feautured Requests</div>
        @foreach($featured as $image)
            <img src="/img/uploads/{{$image->Image->image_name}}" height="100" width="100" alt=""> | Uplaoded by : {{$image->Image->user->username}}
            |  <a href="{{$url->make("admin.images.featured.manage",["id"=>base64_encode($image->id)])}}">View Image </a>  <br>
        @endforeach
        {!! $links !!}
    </div>

@endsection