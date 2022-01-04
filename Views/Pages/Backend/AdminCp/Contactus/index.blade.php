@extends("Layouts.Themes.BaseGrey.Admin")

@section("title")
    Manage Contact form
@endsection


@section("content")


    <div class="container-fluid my-2">
        <div class="row box">
            <div class="col-sm-12 head py-2">Managing Your Contact form</div>
            <div class="col-sm-12">
                This feature is currently classed as beta and can change or be removed without any notice. <br><br>
                Please use the links below to add additonal addresses to contact page  or add Resources such as web or email addresses or telephone numbers.
            </div>
        </div>
    </div>

    <div class="container-fluid my-2">
        <div class="row my-2">
            <div class="col-sm-12 newbtn my-2 text-center text-lg-right pr-lg-2">
                <a class="px-3 py-2 " href="{{$url->make("auth.admin.contact.resources.new")}}">Add New Resource</a>
            </div>
        </div>
        <div class="row box">
            <div class="col-sm-12 head py-2">Manage Resources</div>
            @if($request->resources->count() == 0)
                Sorry No Resources have been found
            @else
                @foreach($request->resources as $resource)
                    <div class="col-sm-12 col-lg-3 py-2">{{$resource->type}}</div>
                    <div class="col-sm-12 col-lg-3 py-2">{{$resource->name}}</div>
                    <div class="col-sm-12 col-lg-3 py-2"><a class="d-block" href="{{$url->make("auth.admin.contact.resources.edit",["id"=>base64_encode($resource->id)])}}" target="_new">Edit Resource</a></div>
                    <div class="col-sm-12 col-lg-3 py-2"><a class="d-block" href="{{$url->make("auth.admin.contact.resources.delete",["id"=>base64_encode($resource->id)])}}">Delete Resource</a></div>
                @endforeach
            @endif
        </div>
    </div>


    <div class="container-fluid my-2">
        <div class="row my-2">
            <div class="col-sm-12 newbtn my-2 text-center text-lg-right pr-lg-2">
                <a class="px-3 py-2 " href="{{$url->make("auth.admin.contact.address.new")}}">Add New Address</a>
            </div>
        </div>
        <div class="row box">
            <div class="col-sm-12 head py-2">Manage Addresses</div>
{{--            Addresses go here--}}
            @if($request->address->count() == 0)
                Sorry No Addresses have been found
            @else
                @foreach($request->address as $address)
                    <div class="col-sm-12 col-lg-4 py-2">{{$address->title}}</div>
                    <div class="col-sm-12 col-lg-4 py-2"><a class="d-block" href="{{$url->make("auth.admin.contact.address.edit",["id"=>base64_encode($address->id)])}}" target="_new">Edit Address</a></div>
                    <div class="col-sm-12 col-lg-4 py-2"><a class="d-block" href="{{$url->make("auth.admin.contact.address.delete",["id"=>base64_encode($address->id)])}}">Delete Address</a></div>
                @endforeach
                @endif
        </div>

    </div>


@endsection