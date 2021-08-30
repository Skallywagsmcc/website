@extends("Layouts.backend")

@section("title")
    Admin panel : New Event
@endsection


@section("content")


    <div class="container my-2">
        <div class="row">
            <div class="col-sm-12 text-center text-md-left pl-md-1"><a href="{{$url->make("auth.admin.events.home")}}">Back to Events Home</a></div>
        </div>
    </div>

    <div class="container my-2">
        <div class="row box">
            <div class="col-sm-12 head py-2 text-center text-md-left pl-md-1"> Basic Event Details</div>
        </div>
    </div>

    @isset($values)
        <div class="container my-2">
            <div class="row box">
                <div class="col sm-12 p-2 text-center">
                    @foreach($values as $value)
                        Missing value : {{$value}} <br>
                    @endforeach
                </div>
            </div>
        </div>
    @endisset


    <form action="{{$url->make("auth.admin.events.store")}}" method="post" class="tld-form" enctype="multipart/form-data">
        <div class="container my-2">
            <div class="row box px-0">
                <div class="col-sm-12 px-2 py-2 px-2">
                    {{csrf()}}
                    <div class="form-group">
                        <label for="title">Event Title</label>
                        <input type="text" class="form-control tld-input" name="title" value="@isset($validate){{$validate->Post("title") }} @endisset" placeholder="Event Title">
                    </div>

                    <div class="form-group">
                        <label for="content">About the event</label>
                        <textarea class="form-control tld-input" rows="10" placeholder="About the event"
                                  name="content"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="start">Event Start time</label>
                        <input type="datetime-local" class="form-control tld-input" name="start">
                    </div>


                    <div class="form-group">
                        <label for="end">Event end time</label>
                        <input type="datetime-local" class="form-control tld-input" name="end">
                    </div>

                </div>
            </div>
        </div>

        <div class="container my-2">
            <div class="row box">
                <div class="head col-sm-12 py-2 text-center text-md-left pl-md-1">Event Location Details</div>
            </div>
        </div>

        <div class="container my-2">
            <div class="row box px-0">
                <div class="col-sm-12 py-2 px-2">
                    <div class="form-group">
                        <label for="name">Building Name or number</label>
                        <input type="text" name="name" class="form-control tld-input">
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="street">Street name</label>
                            <input type="text" name="street" class="form-control tld-input">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="city">City</label>
                            <input type="text" name="city" class="form-control tld-input">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="county">County</label>
                            <input type="text" name="county" class="form-control tld-input">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="postcode">Postcode</label>
                            <input type="text" name="postcode" class="form-control tld-input">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container my-2">
            <div class="row box">
                <div class="col-sm-12">
                    <div class="form-row font-weight-bolder">
                        <div class="col-sm-12 py-2 col-md-9 text-center text-md-right pr-md-1">
                            <label for="route">Add Event Route Upon Completion</label>
                        </div>
                        <div class="col-sm-12 py-2 col-md-3 text-center">
                            <input type="checkbox" name="route" value="1">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row"><input type="file" name="upload"></div>
        </div>

        <div class="container my-2">
            <div class="row box px-0 ">
                <div class="col-sm-12 py-2 px-2">
                    <button class="btn tld-button btn-block">Create Event</button>
                </div>
            </div>
        </div>



    </form>

@endsection()