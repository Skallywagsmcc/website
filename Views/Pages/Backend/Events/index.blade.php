@extends("Layouts.Themes.BaseGrey.Admin")

@section("title")
    Events Manager : Homepage
@endsection


@section("content")



    @isset($error)
        <div class="container my-2">
            <div class="row box">
                @foreach($error as $message)
                <div class="col sm-12 p-2 text-center">{{$message}}</div>
                @endforeach
            </div>
        </div>
    @endisset



    {{--Add New events--}}
    <div class="container my-2">
        <div class="row ">
            <div class="col-sm-12 col-md-6 my-2 my-md-0 text-center text-md-left pl-md-1">
                <a class="py-2 d-block" href="{{$url->make("auth.admin.home")}}"> << Back to admin home</a>
            </div>
            <div class="col-sm-12 col-md-6 new py-2 text-md-right text-center"><a
                        href="{{$url->make("auth.admin.events.new")}}" class=" text-md-right text-center pr-md-1 p-2">Add
                    New Event</a></div>
        </div>
    </div>

    <div class="container d-none d-md-block head box">

        <div class="row text-center head">
            <div class="col-sm-12 col-md-6  text-center">Event Title</div>
            <div class="col-sm-12 col-md-4  text-center">Options</div>
            <div class="col-sm-12 col-md-2  text-center">delete</div>
        </div>
    </div>
    @if($request->event->count() >= 1)

        @foreach($request->event as $event)
            <div class="container my-2 my-md-0">
                <div class="row text-center my-md-0 box withhover title">
                    <div class="col-sm-12 col-md-6 title py-2">{{$event->title}}</div>
                    <div class="col-sm-12 col-md-2 py-2"><a
                                href="{{$url->make("auth.admin.events.edit",["id"=>base64_encode($event->id)])}}">edit this
                            event</a></div>
                    <div class="col-sm-12 col-md-2 py-2 text-center">
                        <a href="{{$url->make("auth.admin.events.delete",["id"=>base64_encode($event->id)])}}">Delete Event</a>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="container my-2">
            <div class="box row">
                <div class="col-sm-12 text-center py-2">No Results found</div>
            </div>
        </div>
    @endif




@endsection