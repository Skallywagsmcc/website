@extends("Layouts.main")

@section("title")
    Our Events
    @endsection

@section("content")
    <div class="container-fluid bg-dark border border-top-1 border-bottom-1 my-2">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 head">Events Coming soon</div>
            </div>
            @foreach($events  as $event)
                {{$event->title}}  <a href="{{$url->make("events.view",["id"=>base64_encode($event->id)])}}">View Event Details</a>
            @endforeach
        </div>
    </div>


@endsection