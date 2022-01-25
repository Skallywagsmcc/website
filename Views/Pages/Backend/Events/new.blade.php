@extends("Layouts.Themes.BaseGrey.Admin")


@section("title")
    Admin panel : New Event
@endsection



@section("content")

    @isset($request->error)
        <div class="container-fluid my-2">
            <div class="row box">
                <div class="col-sm-12 head py-2">An Error occurred</div>
                {{$request->error}}
                @isset($request->required)
                    @foreach($request->required as $required)
                        {{$required}}
                    @endforeach
                @endisset
            </div>
        </div>
    @endisset

    @if($addresses->count() >= 2)

        <div class="container-fluid my-2">
            <div class="row">
                <div class="col-sm-12 text-center text-md-left pl-md-1"><a
                            href="{{$url->make("auth.admin.events.home")}}">Back
                        to Events Home</a></div>
            </div>
        </div>

        <div class="container-fluid my-2">
            <div class="row box">
                <div class="col-sm-12 head py-2 text-center text-md-left pl-md-1"> Basic Event Details</div>
            </div>
        </div>
        <form action="{{$url->make("auth.admin.events.store")}}" method="post" class="tld-form"
              enctype="multipart/form-data">

            <div class="container-fluid my-2">
                <div class="row box px-0">
                    <div class="col-sm-12 px-2 py-2 px-2">
                        {{csrf()}}
                        <div class="form-group">
                            <label for="title">Event Title</label>
                            <input type="text" class="form-control tld-input" name="title"
                                   value="@isset($request->title){{$request->title }}@endisset"
                                   placeholder="Event Title">
                        </div>

                        <div class="form-form">
                            <label for="content">About the event</label>
                            <textarea class="form-control tld-input" rows="10" placeholder="About the event"
                                      name="content">@isset($request->content){{$request->content}}@endisset</textarea>
                        </div>

                        <div class="form-row">
                            <div class="col-sm-12 head">Update Event End time</div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="col-sm-12">
                                    <label for="start">Event Start time</label>
                                </div>
                                <div class="col-sm-12">
                                    <input type="datetime-local" class="form-control tld-input" name="start_date"
                                           value="@isset($request->start_date){{$request->start_date}}@endisset">
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="col-sm-12">
                                    <label for="end">Event end time</label>
                                </div>
                                <div class="col-sm-12"><input type="datetime-local" class="form-control tld-input"
                                                              name="end_date"
                                                              value="@isset($request->end_date){{$request->end_date}}@endisset">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row box">
                    <div class="col-sm-12 head py-2">Manage Event Addresses</div>
                    <div class="col-sm-12 col-lg-6 pr-lg-2 px-0 box my-2">

                        <div class="col-sm-12"><label for="meet_id">Event Meet up</label></div>
                        <div class="col-sm-12 p-2 ">
                            <select name="meet_id" id="" class="form-control my-1">
                                    <option value="0">Current here</option>
                                <option value="0">Make a Selection</option>
                                @foreach($addresses as $address)
                                    <option value="{{$address->id}}">{{$address->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-6 px-0 pl-lg-2 box my-2">
                        <div class="col-sm-12"><label for="dest_id">Event Destination</label></div>
                        <div class="col-sm-12 p-2">
                            <select name="dest_id" id="" class="form-control my-1">
                                <option value="0">Make a Selection</option>
                                @foreach($addresses as $address)
                                    <option value="{{$address->id}}">{{$address->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>


            <div class="container-fluid">
                <div class="row px-0 box">
                    <div class="col-sm-12 head py-2">Update Event Images</div>
                    <div class="col-sm-12 col-lg-6 box my-2 px-0">
                        <div class="col-sm-12"><label for="thumb">Add event thumbnail (required)</label></div>
                        <div class="col-sm-12 py-2">
                            <input type="file" class="form-control" name="thumb">
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6 box my-2 px-0">
                        <div class="col-sm-12"><label for="thumb">Add event Cover image</label></div>
                        <div class="col-sm-12 py-2">
                            <input type="file" class="form-control" name="cover">
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid my-2">
                <div class="row box p ">
                    <div class="col-sm-12 py-2 px-2">
                        <button class="btn tld-button btn-block">Create Event</button>
                    </div>
                </div>
            </div>
        </form>
    @else
        <div class="container-fluid my-2">
            <div class="row box">
                <div class="col-sm-12 head py-2 text-center text-lg-left pl-lg-2">Not Enough Addresses</div>
                <div class="col-sm-12 text-center py-2">Sorry in order to add a new Event a Minimum of 2
                    addresses must be added Before you can create a new event <a
                            href="{{$url->make("auth.admin.addresses.new")}}?entity_name={{base64_encode($request->entity_name)}}">Add
                        a new
                        Address</a></div>
            </div>
        </div>
    @endif





@endsection()