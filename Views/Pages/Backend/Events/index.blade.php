@extends("Layouts.backend")

@section("title")
    Events Manager : Homepage
@endsection


@section("content")

{{--    Search the events here --}}

{{--Add New events--}}
<div class="container">
    <div class="row">
        <div class="col-sm-12"><a href="{{$url->make("auth.admin.events.new")}}" class="d-block text-md-right text-center">Add New Event</a></div>
    </div>
</div>

    <div class="container">

        <div class="row text-center head">
            <div class="col-sm-12 col-md-6 text-center">Event Title</div>
            <div class="col-sm-12 col-md-6 text-center">OPtions</div>
        </div>
    <div class="row text-center">
            @foreach($events as $event)
                <div class="col-sm-12 col-md-6">{{$event->title}}</div>
                <div class="col-sm-12 col-md-6"><a href="{{$url->make("auth.admin.events.edit",["id"=>base64_encode($event->id)])}}">Manage this event</a></div>


            @endforeach
        </div>
    </div>


    @endsection