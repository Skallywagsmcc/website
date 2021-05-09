@extends("Layouts.main")

@section("title")
    Events Manager
@endsection


@section("content")
    <div class="container">
        <div class="row">
            <div class="col-sm-12 head">All Created Events</div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-3">Event Title</div>
            <div class="col-sm-12 col-md-3">Event Start</div>
            <div class="col-sm-12 col-md-3">Event end</div>
            <div class="col-sm-12 col-md-3">OPtions</div>
        </div>
    <div class="row">
            @foreach($events as $event)
                <div class="col-sm-12 col-md-3">{{$event->title}}</div>
                <div class="col-sm-12 col-md-3">{{date("d/m/Y",strtotime($event->start))}} at {{date("H:i:s a",strtotime($event->start))}}</div>
                <div class="col-sm-12 col-md-3">{{date("d/m/Y",strtotime($event->end))}} at {{date("H:i:s a",strtotime($event->end))}}</div>
                <div class="col-sm-12 col-md-3"><a href="{{$url->make("admin.events.edit",["id"=>base64_encode($event->id)])}}">view</a></div>

                <?php
                $address = explode(",",$event->address);
                for($i=0;$i< count($address); $i++)
                    {
                        echo $address[$i];
                    }
                ?>

            @endforeach
        </div>
    </div>


    @endsection