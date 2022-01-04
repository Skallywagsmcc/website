@extends("Layouts.Themes.BaseGrey.Admin")


@section("title")
    {{$_ENV['APP_NAME']}} Admin panel Addresses
@endsection

@section("content")

    @isset($request->error)
        <div class="container-fluid my-2">
            <div class="row box">
                <div class="col-sm-12 head py-2 text-center text-lg-left pl-lg-2">An Error Occurred</div>
                <div class="col-sm-12 text-center">{{$request->error}}</div>
            </div>
        </div>
    @endisset
    <div class="container-fluid my-2">
        <div class="row">
            <div class="col-sm-12 text-center text-lg-right pr-lg-right py-2 box mx-2  mx-lg-0">
                <a href="{{$url->make("auth.admin.addresses.new")}}">Add a General Address</a>
            </div>
        </div>
    </div>
    <div class="container-fluid my-2">
        <div class="row box d-none d-lg-flex">
            <div class="col-sm-12 col-lg-2 py-2 head text-center">Address Name</div>
            <div class="col-sm-12 col-lg-2 py-2 head text-center">Request type</div>
            <div class="col-sm-12 col-lg-8 py-2 head text-center">Options</div>
        </div>
    </div>
    <div class="container-fluid my-2">
        @if($addresses->count()==0)
            No Addresses found
        @else
            @foreach($addresses as $address)
                <div class="row  box my-2 my-lg-1">
                    <div class="col-sm-12 col-lg-2 py-2  text-center">{{$address->title}}</div>
                    <div class="col-sm-12 col-lg-2 py-2 text-center">{{$address->entity_name}}</div>
                    <div class="col-sm-12 col-lg-2 py-2  text-center"><a class="d-block" href="{{$url->make("auth.admin.addresses.view",["id"=>base64_encode($address->id)])}}">View Address</a></div>
                    <div class="col-sm-12 col-lg-3 py-2  text-center"><a class="d-block" href="{{$url->make("auth.admin.addresses.edit",["id"=>base64_encode($address->id)])}}">Edit Address</a></div>
                    <div class="col-sm-12 col-lg-3 py-2 text-center"><a class="d-block" href="{{$url->make("auth.admin.addresses.delete",["id"=>base64_encode($address->id)])}}">Delete Address</a></div>
                </div>
            @endforeach
                {!! $links !!}
        @endif
    </div>
@endsection