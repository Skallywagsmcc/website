@extends("Layouts.main")

@section("title")
    Events viewer {{$event->title}}
@endsection

@section("content")


    <div class="container my-2">
        <div class="row">
            <div class="col-sm-12 head">{{$event->title}}</div>
            <div class="col-sm-12 d-flex justify-content-center h-50">
                <img src="/img/uploads/{{$event->image->name}}" class="h-50 img-fluid w-50" alt="">
            </div>
        </div>
    </div>


    <div id="tabs" class="my-2 container">
        <div class="col-sm-12 head d block d-md-none">Sub menu</div>
        <ul class="row text-center subnav px-0">
            <li class="col-sm-12 col-md-3"><a href="#tabs-1" class="d-block py-2">About the event</a></li>
            <li class="col-sm-12 col-md-3"><a href="#tabs-2" class="d-block py-2">Event Times</a></li>
            <li class="col-sm-12 col-md-3"><a href="#tabs-3" class="d-block py-2">Stopping Points</a></li>
            <li class="col-sm-12 col-md-3"><a href="#tabs-4" class="d-block py-2">Address Details</a></li>
        </ul>

        <div class="row">
            <div class="col-sm-12">

                <div id="tabs-1">
                    <div class="col-sm-12 head">About the Event</div>
                    <div class="col-sm-12">{{$event->content}}</div>
                </div>

                <div id="tabs-2">
                    <div class="col-sm-12 head">Event Dates and Times</div>
                    <div class="col-sm-12 text-center info my-2 py-2">This event Starts at {{date("H:i",strtotime($event->start))}} {{date("d/m/Y",strtotime($event->start))}} </div>
                    <div class="col-sm-12 text-center my-2 info py-2">This event Ends at {{date("H:i",strtotime($event->start))}} {{date("d/m/Y",strtotime($event->start))}} </div>
                </div>
                <div id="tabs-3" class="px-1">
                    @foreach($event->stops as $stops)
                        @php
                            $address = explode(",",$stops->location);
                        @endphp
                        <div class="row ettab info my-2">
                            <div class="col-sm-12 my-2 text-right pr-3 etlink"><a href="#">View Address</a></div>
                            <div class="etlocations my-2">
                                <div class="col-sm-12">House number / Building Name : {{$address[0]}}</div>
                                <div class="col-sm-12">Street name: {{$address[1]}}</div>
                                <div class="col-sm-12">City : {{$address[2]}}</div>
                                <div class="col-sm-12">County : {{$address[3]}}</div>
                                <div class="col-sm-12">Postcode : {{$address[4]}}</div>
                            </div>

                        </div>
                    @endforeach
                </div>
                <div id="tabs-4">
                    @php
                    $address = explode(",", $event->address);
                    @endphp
                    <div class="row">
                        <div class="col-sm-12 head">Address Details</div>
                        <div class="col-sm-12">House number / Building Name : {{$address[0]}}</div>
                        <div class="col-sm-12">Street name: {{$address[1]}}</div>
                        <div class="col-sm-12">City : {{$address[2]}}</div>
                        <div class="col-sm-12">County : {{$address[3]}}</div>
                        <div class="col-sm-12">Postcode : {{$address[4]}}</div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
