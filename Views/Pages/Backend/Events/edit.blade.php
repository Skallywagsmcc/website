@extends("Layouts.backend")

@section("title")
    Admin panel : Update  Event
@endsection



@section("content")


    <div class="container my-2">
        <div class="row">
            <div class="col-sm-12 text-center text-md-left pl-md-1"><a href="{{$url->make("auth.admin.events.home")}}">Back to Events Home</a></div>
        </div>
    </div>

    <div class="container my-2">
        <div class="row box">
            <div class="col-sm-12 head py-2 text-center text-md-left pl-md-1">Update Basic Event Details</div>
        </div>
    </div>



    <form action="{{$url->make("auth.admin.events.update")}}" method="post" class="tld-form">
        {{csrf()}}

        <div class="container">
            <div class="row box px-0">
                <div class="col-sm-12 p-2">
                    <input type="text" value="{{$event->id}}" name="id">
                    <div class="form-group">
                        <label for="title">Event Title</label>
                        <input type="text" class="form-control tld-input" name="title"
                               placeholder="Event Title" value="{{$event->title}}">
                    </div>

                    <div class="form-group">
                        <label for="content">About the event</label>
                        <textarea class="form-control tld-input" rows="10" placeholder="About the event"
                                  name="content">{{$event->content}}</textarea>
                    </div>
                </div>
            </div>

            <div class="container my-2 px-0">
                <div class="row box px-0">
                    <div class="col-sm-12 head py-2 text-center text-md-left pl-md-1">Update start and end time and
                        date
                    </div>
                </div>
            </div>

            <div class="container my-2 px-0">
                <div class="row box px-0">
                    <div class="col-sm 12 p-2">
                        <div class="my-2">
                            Change Event Start Date and time : <input type="checkbox" class="toggle_check" name="ms"
                                                                      value="1">
                            <hr class="bg-light">
                            <div class="toggled_content">
                                <div class="form-group">
                                    <label for="start">Event Start time</label>
                                    <input type="datetime-local" class="form-control tld-input" name="start"
                                           value="{{$event->start}}">
                                </div>
                            </div>
                        </div>
                        <div class=we my-2>
                            Change Event End Date and time : <input type="checkbox" class="toggle_check" name="me"
                                                                    value="1">
                            <hr class="bg-light">
                            <div class="toggled_content">
                                <div class="form-group">
                                    <label for="end">Event end time</label>
                                    <input type="datetime-local" class="form-control tld-input" name="end"
                                           value="{{$event->end}}">
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>


            <div class="container my-2 px-0">
                <div class="row box px-0">
                    <div class="col-sm-12 head py-2 text-center text-md-left pl-md-1">Update Location Details
                    </div>
                </div>
            </div>

            <div class="container my-2 px-0">
                <div class="row box px-0">
                    <div class="col-sm-12 p-2">
                        <div class="form-group">
                            <label for="name">Building Name or number</label>
                            <input type="text" name="name" class="form-control tld-input" tld-input"
                            value="{{$address[0]}}">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="street">Street name</label>
                                <input type="text" name="street" class="form-control tld-input" tld-input"
                                value="{{$address[1]}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="city">City</label>
                                <input type="text" name="city" class="form-control tld-input" tld-input"
                                value="{{$address[2]}}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="county">County</label>
                                <input type="text" name="county" class="form-control tld-input"" value="{{$address[3]}}
                                ">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="postcode">Postcode</label>
                                <input type="text" name="postcode" class="form-control tld-input""
                                value="{{$address[4]}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="container my-2 px-0">
                <div class="row box px-0">
                    <div class="col-sm-12 p-2">
                        <button class="btn tld-button btn-block">Update Event</button>
                    </div>
                </div>
            </div>


    </form>
@endsection()