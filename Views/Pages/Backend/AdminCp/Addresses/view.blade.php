@extends("Layouts.backend")

@section("title")
    {{$_ENV['APP_NAME']}} Admin panel Addresses
@endsection

@section("content")
    <div class="container my-2">
        <div class="row box">
            <div class="col-sm-12 head py-2 pl-lg-2 text-center text-lg-left">Address View : {{$address->first()->title}}</div>
            <div class="col-sm-12 text-center py-2 text-lg-left pl-lg-2">Building Name Or Number : {{$address->first()->name}}</div>
            <div class="col-sm-12 text-center py-2 text-lg-left pl-lg-2">Street Name : {{$address->first()->street}}</div>
{{--            if empty hide--}}
            @if(!empty($address->first()->street_2))
            <div class="col-sm-12 text-center py-2 text-lg-left pl-lg-2">Street Name : {{$address->first()->street_2}}</div>
            @endif
            <div class="col-sm-12 text-center py-2 text-lg-left pl-lg-2">City : {{$address->first()->city}}</div>
            <div class="col-sm-12 text-center py-2 text-lg-left pl-lg-2">County : {{$address->first()->county}}</div>
            <div class="col-sm-12 text-center py-2 text-lg-left pl-lg-2">Postcode {{$address->first()->postcode}}</div>
        </div>

        <div class="row box my-2">
            <div class="col-sm-12 col-lg-6 text-center py-2"><a href="{{$url->make("auth.admin.addresses.edit",["id"=>base64_encode($address->first()->id)])}}">Edit Address</a></div>
            <div class="col-sm-12 col-lg-6 text-center py-2"><a href="{{$url->make("auth.admin.addresses.delete",["id"=>base64_encode($address->first()->id)])}}">Delete Address</a></div>
        </div>
    </div>
@endsection