@extends("Layouts.backend")

@section("title")
    Admin panel : New Event
@endsection


@section("content")
    @isset($message)
        <div class="container">
            <div class="row col-sm-12">An Error Occurred : {{$message}}</div>
        </div>
        @endisset


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
                <div class="head col-sm-12 py-2 text-center text-md-left pl-md-1">Event Start Location Details</div>
            </div>
        </div>

        <div class="container my-2">
            <div class="row box px-0">
                <div class="col-sm-12 py-2 px-2">
                    <div class="form-group">
                        <label for="name">Building Name or number</label>
                        <input type="text" name="esl_name" class="form-control tld-input">
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="street">Street name</label>
                            <input type="text" name="esl_street" class="form-control tld-input">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="city">City</label>
                            <input type="text" name="esl_city" class="form-control tld-input">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="county">County</label>
                            <input type="text" name="esl_county" class="form-control tld-input">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="postcode">Postcode</label>
                            <input type="text" name="esl_postcode" class="form-control tld-input">
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container my-2">
            <div class="row box">
                <div class="head col-sm-12 py-2 text-center text-md-left pl-md-1">Event End Location Details</div>
            </div>
        </div>


        <div class="container my-2">
            <div class="row box px-0">
                <div class="col-sm-12 py-2 px-2">
                    <div class="form-group">
                        <label for="name">Building Name or number</label>
                        <input type="text" name="eel_name" class="form-control tld-input">
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="street">Street name</label>
                            <input type="text" name="eel_street" class="form-control tld-input">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="city">City</label>
                            <input type="text" name="eel_city" class="form-control tld-input">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="county">County</label>
                            <input type="text" name="eel_county" class="form-control tld-input">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="postcode">Postcode</label>
                            <input type="text" name="eel_postcode" class="form-control tld-input">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container my-2">
            <div class="row box">
                <div class="col-sm-12">Upload Event Thumbnail</div>
            </div>
        </div>

        <div class="container">
            <div class="row box py-2">
                <div class="col-sm-12">
                    <input type="file" class="form-control tld-input" name="upload">
                </div>
            </div>
        </div>

        <div class="container my-2">
        <div class="row box py-2">
            <div class="col-sm-12">
                <input type="url" name="map_url" class="form-control tld-input" value="" placeholder="Url to Map">
            </div>
        </div>
    </form>
        <div class="container my-2">
            <div class="row box p ">
                <div class="col-sm-12 py-2 px-2">
                    <button class="btn tld-button btn-block">Create Event</button>
                </div>
            </div>
        </div>



    </form>

@endsection()