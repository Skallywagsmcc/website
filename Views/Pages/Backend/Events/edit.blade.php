@extends("Layouts.main")

@section("title")
    Admin panel : New Event
@endsection


@section("content")

    <div class="container">
        <form action="{{$url->make("admin.events.update")}}" method="post">
            {{csrf()}}

            <input type="text" value="{{$event->id}}" name="id">
            <div class="form-group">
                <label for="title">Event Title (this cannot be changed)</label>
                <input type="text" class="form-control-plaintext text-white" readonly name="title"
                       placeholder="Event Title" value="{{$event->title}}">
            </div>

            <div class="form-group">
                <label for="content">About the event</label>
                <textarea class="form-control" rows="10" placeholder="About the event"
                          name="content">{{$event->content}}</textarea>
            </div>


            <div class="bg-dark my-2">
                Change Event Start Date and time : <input type="checkbox" class="toggle_check" name="ms" value="1">
                <hr class="bg-light">
                <div class="toggled_content">
                    <div class="form-group">
                        <label for="start">Event Start time</label>
                        <input type="datetime-local" class="form-control" name="start" value="{{$event->start}}">
                    </div>
                </div>
            </div>
            <div class=bg-dark my-2>
                Change Event End Date and time : <input type="checkbox" class="toggle_check" name="me" value="1">
                <hr class="bg-light">
                <div class="toggled_content">
                    <div class="form-group">
                        <label for="end">Event end time</label>
                        <input type="datetime-local" class="form-control" name="end" value="{{$event->end}}">
                    </div>
                </div>


            </div>

            <div class="col-sm-12 head">Location Details</div>

            <div class="form-group">
                <label for="name">Building Name or number</label>
                <input type="text" name="name" class="form-control" value="{{$address[0]}}">
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street">Street name</label>
                    <input type="text" name="street" class="form-control" value="{{$address[1]}}">
                </div>
                <div class="form-group col-md-6">
                    <label for="city">City</label>
                    <input type="text" name="city" class="form-control" value="{{$address[2]}}">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="county">County</label>
                    <input type="text" name="county" class="form-control" value="{{$address[3]}}">
                </div>
                <div class="form-group col-md-6">
                    <label for="postcode">Postcode</label>
                    <input type="text" name="postcode" class="form-control" value="{{$address[4]}}">
                </div>
            </div>

            <button class="btn btn-primary btn-block">Creat Event</button>


        </form>
    </div>
@endsection()