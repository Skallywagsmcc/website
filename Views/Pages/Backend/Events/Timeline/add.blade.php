@extends("Layouts.backend")

@section("title")
    Events: Add to Timeline
@endsection


@section("content")
    <div class="container my-2">
        <div class="row box">
            <div class="col-sm-12 head py-2 text-center text-md-left pl-md-1">Current Route So far</div>
        </div>
    </div>

<<<<<<< HEAD

    <div class="container my-2">
        @if($timelines->count() == 0)
            <div class="row box">
                Sorry it seems no route has been added so far
            </div>
        @else
            @isset($pwmessage)
                <div class="row box">
                    <div class="col-sm-12 py-2 my-2 text-center">Error :{{$pwmessage}}</div>
                </div>
            @endisset
            <form action="{{$url->make("auth.admin.events.routes.delete")}}" method="post" class="tld-form">
                {{csrf()}}
                @foreach($timelines as $et)

                    <div class="row box py-2 my-2 my-md-0">
                        <div class="col-sm-12 col-md-6">
                            @php
                                $location = explode(",",$et->location)
                            @endphp
                            {{$location[0]}} {{$location[4]}}
                        </div>
                        {{--                        <div class="col-sm-12 col-md-3">--}}
                        {{--                            <input type="text" name="order_id" value="{{$et->order_id}}">--}}
                        {{--                        </div>--}}
                        <div class="col-sm-12 col-md-3">
                            <a href="{{$url->make("auth.admin.events.routes.edit",["id"=>base64_encode($et->id)])}}">Edit
                                this stop {{$et->id}}</a>
                        </div>

                        <div class="col-sm-12 col-md-3">
                            <input type="checkbox" name="id[]" value="{{$et->id}}">
                        </div>
                    </div>
                @endforeach
                <div class="row box">
                    <div class="col-sm-12 py-2"><input type="password" class="tld-input form-control" name="password" placeholder="Required Password"></div>
                </div>
                <div class="row">
                    <button class="btn tld-button btn-block">Delete Routes</button>
                </div>
            </form>
        @endif
=======
    <form action="{{$url->make("auth.admin.events.routes.uoid")}}" method="post" class="tld-form">
        <div class="container my-2">
            @if($timelines->count() == 0)
                <div class="row.box">
                    Sorry it seems no route has been added so far
                </div>
            @else
                @foreach($timelines as $et)
                    <div class="row box py-2 my-2 my-md-0">
                        <div class="col-sm-12 col-md-3">
                            @php
                             $location = explode(",",$et->location)
                             @endphp
                            {{$location[0]}} {{$location[4]}}
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <input type="text" name="order_id[]" value="{{$et->order_id}}">
                        </div>
                        <input type="text" name="id[]" value="{{$et->id}}">
                        <div class="col-sm-12 col-md-3">
                            <a href="{{$url->make("auth.admin.events.routes.edit",["id"=>base64_encode($et->id)])}}">Edit this stop {{$et->id}}</a>
                        </div>
                    </div>
                @endforeach
            @endif
            <div class="row">
            </div>

            <container>
                <div class="row">
                    <div class="col-sm-12 p-4">
                        <button class="btn tld-button btn-block">Update changes</button>
                    </div>
                </div>
            </container>
    </form>

>>>>>>> 6884d7fa6c93e09ef874fda9693cf4e9cf7a6008
    </div>
    <div class="container my-2">
        <div class="row box px-0">
            <div class="col-sm-12 head py-2 text-center text-md-left pl-md-1">Add The Location Stopping Points</div>
        </div>
    </div>
<<<<<<< HEAD
        <form action="{{$url->make("auth.admin.events.routes.add")}}" method="post" class="tld-form">

            <div class="container my-2">
                {{csrf()}}
                <div class="row box px-0">
                    <div class="col-sm-12">
                        <input type="text" name="id" value="{{$event->id}}">
                        <div class="form-row">
                            <div class="col-sm-12 col-md-3 py-2 py-md-3">
                                <label for="location">Number or building name </label>
                            </div>
                            <div class="col-sm-12 col-md-8 py-2"><input type="text" name="name"
                                                                        class="form-control tld-input"></div>
                        </div>

                        <div class="form-row">
                            <div class="col-sm-12 col-md-3 py-2 py-md-3">
                                <label for="location">Street name </label>
                            </div>
                            <div class="col-sm-12 col-md-8 py-2"><input type="text" name="street_name"
                                                                        class="form-control tld-input"></div>
                        </div>

                        <div class="form-row">
                            <div class="col-sm-12 col-md-3 py-2 py-md-3">
                                <label for="location">City </label>
                            </div>
                            <div class="col-sm-12 col-md-8 py-2"><input type="text" name="city"
                                                                        class="form-control tld-input"></div>
                        </div>

                        <div class="form-row">
                            <div class="col-sm-12 col-md-3 py-2 py-md-3">
                                <label for="location">County </label>
                            </div>
                            <div class="col-sm-12 col-md-8 py-2"><input type="text" name="county"
                                                                        class="form-control tld-input"></div>
                        </div>

                        <div class="form-row">
                            <div class="col-sm-12 col-md-3 py-2 py-md-3">
                                <label for="location">PostCode </label>
                            </div>
                            <div class="col-sm-12 col-md-8 py-2"><input type="text" name="postcode"
                                                                        class="form-control tld-input"></div>
                        </div>


                    </div>
                </div>
            </div>



            <div class="container my-2">
                <div class="row">
                    <div class="col-sm-12 py-2">
                        <button class="btn-block tld-button btn">Add to Route</button>
                    </div>
                </div>
        </form>
=======
    <form action="{{$url->make("auth.admin.events.routes.add")}}" method="post" class="tld-form">
        {{csrf()}}
        <div class="container my-2">
            <div class="row box px-0">
                <div class="col-sm-12">
                    <input type="text" name="id" value="{{$event->id}}">
                    <div class="form-row">
                        <div class="col-sm-12 col-md-3 py-2 py-md-3">
                            <label for="location">Number or building name </label>
                        </div>
                        <div class="col-sm-12 col-md-8 py-2"><input type="text" name="name" class="form-control tld-input"></div>
                    </div>

                    <div class="form-row">
                        <div class="col-sm-12 col-md-3 py-2 py-md-3">
                            <label for="location">Street name </label>
                        </div>
                        <div class="col-sm-12 col-md-8 py-2"><input type="text" name="street_name"
                                                                    class="form-control tld-input"></div>
                    </div>

                    <div class="form-row">
                        <div class="col-sm-12 col-md-3 py-2 py-md-3">
                            <label for="location">City </label>
                        </div>
                        <div class="col-sm-12 col-md-8 py-2"><input type="text" name="city"
                                                                    class="form-control tld-input"></div>
                    </div>

                    <div class="form-row">
                        <div class="col-sm-12 col-md-3 py-2 py-md-3">
                            <label for="location">County </label>
                        </div>
                        <div class="col-sm-12 col-md-8 py-2"><input type="text" name="county"
                                                                    class="form-control tld-input"></div>
                    </div>

                    <div class="form-row">
                        <div class="col-sm-12 col-md-3 py-2 py-md-3">
                            <label for="location">PostCode </label>
                        </div>
                        <div class="col-sm-12 col-md-8 py-2"><input type="text" name="postcode"
                                                                    class="form-control tld-input"></div>
                    </div>


                </div>
            </div>
        </div>

        <div class="container my-2">
            <div class="row box">
                <div class="col-sm-12 head text-center text-md-left pl-md-1 py-2">Map of Route</div>
            </div>
        </div>


        <div class="container my-2">
            <div class="row ">
                <div class="col-sm-12 py-2 box">Add Another Stops : <input type="checkbox" name="more" value="1"></div>
                <div class="col-sm-12  py-2">
                    <button class="btn-block tld-button btn">Add to Route</button>
            </div>
        </div>
    </form>
>>>>>>> 6884d7fa6c93e09ef874fda9693cf4e9cf7a6008
@endsection