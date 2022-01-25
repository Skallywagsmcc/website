@extends("Layouts.Themes.BaseGrey.Admin")

@section("title")
    Admin panel : Update  Event
@endsection



@section("content")
    @isset($request->error)
        @if($request->error == true)
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
            @endif
    @endisset


    <div class="container my-2">
        <div class="row">
            <div class="col-sm-12 text-center  text-md-left pl-md-1"><a href="{{$url->make("auth.admin.events.home")}}">Back
                    to Events Home</a></div>
        </div>
    </div>


{{--    {{$request->HRFS($request->event->Image->size)}}--}}


    <form action="{{$url->make("auth.admin.events.update",["id"=>base64_encode($request->event->id)])}}" method="post" class="tld-form"
          enctype="multipart/form-data">

        <div class="container-fluid my-2">
            <div class="row box px-0">
                <div class="col-sm-12 px-2 py-2 px-2">
                    {{csrf()}}
                    <input type="text" name="id" value="{{$request->event->id}}">
                    <div class="form-group">
                        <label for="title">Event Title</label>
                        <input type="text" class="form-control tld-input" name="title"
                               value="@isset($request->title){{$request->title }}@else{{$request->event->title}}@endisset"
                               placeholder="Event Title">
                    </div>

                    <div class="form-form">
                        <label for="content">About the event</label>
                        <textarea class="form-control tld-input" rows="10" placeholder="About the event"
                                  name="content">@isset($request->content){{$request->content}}@else{{$request->event->content}}@endisset</textarea>
                    </div>

                    <div class="form-row">
                        <div class="col-sm-12 head">Update Event End time</div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="col-sm-12">
                                <label for="start">Event Start time</label>
                            </div>
                            <div class="col-sm-12">
                                <input type="datetime-local" class="form-control tld-input" name="start_date"
                                       value="@isset($request->start_date){{$request->start_date}}@else{{date("Y-m-d\TH:s",strtotime($request->event->start_at))}}@endisset">
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="col-sm-12">
                                <label for="end">Event end time</label>
                            </div>
                            <div class="col-sm-12"><input type="datetime-local" class="form-control tld-input"
                                                          name="end_date"
                                                          value="@isset($request->end_date){{$request->end_date}}@else{{date("Y-m-d\TH:s",strtotime($request->event->end_at))}}@endisset">
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
                            <select name="meet_id" id="" class="form-control my-1">#
{{--                                Add the current selected here--}}
                                <option value="{{$request->event->meet->id}}">Current  : {{$request->event->meet->title}}</option>
                                <option value="0">-------------------------------------------</option>
                                @foreach($addresses as $address)
                                    <option value="{{$address->id}}">{{$address->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-6 px-0 pl-lg-2 box my-2">
                        <div class="col-sm-12"><label for="dest_id">Event Destination</label></div>
                        <div class="col-sm-12 p-2">
                            <select name="dest_id" id="" class="form-control my-1">    Add the current selected here--}}
                                <option value="{{$request->event->destination->id}}">Current  : {{$request->event->destination->title}}</option>
                                <option value="0">-------------------------------------------</option>
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
                        <div class="col-sm-12"><label for="cover">Add event Cover image</label></div>
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

    <script>
        $("document").ready()
        {

            // $(".file").hide()
            $(".addfile").click(
                function () {
                    var Filebox = $(this).parents(".file_box");
                    $(this).hide();
                    Filebox.children(".file_value").text("File Currently being Chosen")
                    Filebox.children(".file").click();
                    $("#update_thumb").prop("checked", true);
                    Filebox.children(".cancelfile").show();
                    $(".file").on("change", function () {


                        $(".file_value").text("Currently Chosen :" + $('.file').val().split('\\').pop())
                        Filebox.append('<a href="#" class="cancelfile">Cancel File Upload</a>')
                    })
                    return false
                })

            $("body").on("click", ".cancelfile", function () {
                var Filebox = $(this).parents(".file_box");
                Filebox.children("#update_thumb").prop("checked", false);
                if (Filebox.children("#update_thumb").prop("checked") == false) {
                    Filebox.children(".file").val("");
                    Filebox.children(".file_value").text("");
                    Filebox.children(".addfile").show();
                    Filebox.children(".cancelfile").remove();
                }
            })

        }
    </script>
@endsection()