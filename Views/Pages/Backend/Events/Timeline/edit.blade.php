@extends("Layouts.backend")

@section("title")
    Events: Add to Timeline
@endsection


@section("content")
@isset($message)
    <div class="container my-2">
        <div class="row box">
            <div class="col-sm-12 py-2 text-center">{{$message}}</div>
        </div>
    </div>
    @endisset
    <div class="container my-2">
        <div class="row box px-0">
            <div class="col-sm-12 head py-2 text-center text-md-left pl-md-1">Add The Location Stopping Points</div>
        </div>
    </div>
    <form action="{{$url->make("auth.admin.events.routes.update")}}" method="post" class="tld-form">
        {{csrf()}}
        <div class="container my-2">
            <div class="row box px-0">
                <div class="col-sm-12">
                    <input type="text" name="id" value="{{$timeline->id}}">
                    <div class="form-row">
                        <div class="col-sm-12 col-md-3 py-2 py-md-3">
                            <label for="location">Number or building name </label>
                        </div>
                        <div class="col-sm-12 col-md-8 py-2"><input type="text" name="name" class="form-control tld-input" value="{{$location[0]}}"></div>
                    </div>

                    <div class="form-row">
                        <div class="col-sm-12 col-md-3 py-2 py-md-3">
                            <label for="location">Street name </label>
                        </div>
                        <div class="col-sm-12 col-md-8 py-2"><input type="text" name="street" value="{{$location[1]}}"
                                                                    class="form-control tld-input"></div>
                    </div>

                    <div class="form-row">
                        <div class="col-sm-12 col-md-3 py-2 py-md-3">
                            <label for="location">City </label>
                        </div>
                        <div class="col-sm-12 col-md-8 py-2"><input type="text" name="city" value="{{$location[2]}}"
                                                                    class="form-control tld-input"></div>
                    </div>

                    <div class="form-row">
                        <div class="col-sm-12 col-md-3 py-2 py-md-3">
                            <label for="location">County </label>
                        </div>
                        <div class="col-sm-12 col-md-8 py-2"><input type="text" name="county" value="{{$location[3]}}"
                                                                    class="form-control tld-input"></div>
                    </div>

                    <div class="form-row">
                        <div class="col-sm-12 col-md-3 py-2 py-md-3">
                            <label for="location">PostCode </label>
                        </div>
                        <div class="col-sm-12 col-md-8 py-2"><input type="text" name="postcode" value="{{$location[4]}}" class="form-control tld-input"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container my-2">
            <div class="row box col-sm-12 py-2 text-center">
                <input type="password" class="tld-input form-control" name="password" placeholder="Enter Required Password">
            </div>
        </div>

        <div class="container my-2">
            <div class="row ">
                <div class="col-sm-12  py-2">
                    <button class="btn-block tld-button btn">Update this stop</button>
            </div>
        </div>
    </form>
@endsection