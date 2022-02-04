@extends("Layouts.main")

@section("title")
    Contact us
@endsection

@section("head")
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
        function onSubmit(token) {
            document.getElementById("contactus-form").submit();
        }
    </script>
@endsection

@section("content")


    @isset($requests)
        @if($requests->settings->first()->lock_submissions==1)
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 head">An Error Occurred</div>
                    {{$requests->settings->first()->lock_message}}
                </div>
                <div class="col-sm-12">Please email us on :
                    @if(!empty($requests->settings->first()->contct_email))
                        {{$requests->settings->first()->contact_email}}
                    @endif
                </div>
            </div>
        @else

            @isset($error)
                <div class="container my-2">
                    <div class="row mx-1">
                        <div class="col-sm-12 head">An Error Occurred</div>
                        <div class="col-sm-12 text-center">{{$error}}</div>
                        @isset($rmf)
                            <div class="col-sm-12 text-center">
                                @foreach($rmf as $required)
                                    {{str_replace("_"," ",$required)}}  ,
                                @endforeach
                            </div>
                        @endisset
                    </div>
                </div>
            @endisset




            <div class="container my-2">
                <div class="row mx-1">
                    <div class="col-sm-12 col-md-8">
                        <form action="/contact-us" class="tld-form" method="post" id="contactus-form">
                            <div class="row">
                                <div class="col-sm-12 head">Contact us</div>
                            </div>


                            {{--                            TODO Add Subject here with a drop down--}}
                            <div class="form-group">
                                <label for="email">Reason for contacting us:</label>
                                <select name="subject" id="" class="form-control bg-dark text-white">
                                    <option value="General Question" class="form-control py-2">General Question</option>
                                    <option value="Membership Question" class="form-control py-2">Membership Question
                                    </option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="email">Email Address:</label>
                                <input type="text" class="form-control tld-input" name="email"
                                       value="@isset($requests){{$requests->email}}@endisset">
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="">First Name :</label>
                                    <input type="text" class="form-control tld-input" name="first_name"
                                           value="@isset($requests){{$requests->first_name}}@endisset">
                                </div>


                                <div class="form-group col-md-6">
                                    <label for="">Last Name :</label>
                                    <input type="text" class="form-control tld-input" name="last_name"
                                           value="@isset($requests){{$requests->last_name}}@endisset">
                                </div>
                            </div>
                            <hr>


                            <div class="form-row">
                                <label for="clubmember">Are you Part of Club</label>
                                <div class="col-sm-12  text-right pr-2">Yes : <input type="radio" class="scn"
                                                                                     name="clubmember" value="1"></div>
                                <div class="col-sm-12  text-right pr-2">No : <input type="radio" class="hcn" checked
                                                                                    name="clubmember" value="0"></div>
                            </div>


                            <div class="form-row clubname">
                                <label for="clubmember">Your Current Club Name</label>
                                <input type="text" class="form-control tld-input" name="club"
                                       value="@isset($requests){{$requests->club}}@endisset">
                            </div>

                            <div class="form-group">
                                <label for="message">Your Message </label>
                                <textarea id="message" name="message"
                                          class="form-control tld-input">@isset($requests){{$requests->message}}@endisset</textarea>
                            </div>

                            <button class="g-recaptcha btn btn-primary"
                                    data-sitekey="6LcklagdAAAAAAb7fXVtUQAdaJMPWk68K_pqztt4"
                                    data-callback='onSubmit'
                                    data-action='contactus'>Save
                            </button>
                        </form>

                    </div>

                    <div class="col-sm-12 col-lg-4 my-3 my-lg-0">
                        <div class="col-sm-12 head">Useful Resources</div>
                        @if($requests->AllResources($requests->entity_name)->count() == 0)
                            <div class="col-sm-12">
                                No Resources found
                            </div>
                        @else
                            @foreach($requests->AllResources($requests->entity_name) as $resources)
                                <div class="col-sm-12">
                                    @if($resources->type == "email")
                                        <a href="mailto:{{$resources->value}}">{{$resources->name}}}</a>
                                        @elseif($resources->type == "url")
                                        <a href="http://{{$resources->value}}">{{$resources->name}}</a>
                                    @elseif($resources->type=="telephone")
                                       Call :  <a href="tel:{{$resources->value}}">{{$resources->name}}</a>
                                    @endif
                                </div>
                            @endforeach
                        @endif
                    </div>

                </div>
            </div>
        @endif


        <div class="container my-2">
            <div class="row">
                @foreach($address as $address)
                    <div class="col-sm-12 col-lg-4 my-2">
                        <div class="col-sm-12 head">{{$address->title}}</div>
                        <div class="col-sm-12 py-2 text-left pl-2">{{$address->name}}</div>
                        <div class="col-sm-12 py-2 text-left pl-2">{{$address->street}}</div>
                        @if(!empty($address->street_2))
                            <div class="col-sm-12 py-2 text-left pl-2">{{$address->street_2}}</div>
                        @endif
                        <div class="col-sm-12 py-2 text-left pl-2">{{$address->city}}</div>
                        <div class="col-sm-12 py-2 text-left pl-2">{{$address->county}}</div>
                        <div class="col-sm-12 py-2 text-left pl-2">{{$address->postcode}}</div>
                    </div>
                @endforeach
            </div>
        </div>
    @endisset

    <script>


        $("document").ready(function () {
            //    hide content

            $(".clubname").hide();

            $(".scn").click(function () {
                $(".clubname").show();
            })

            $(".hcn").click(function () {
                $(".clubname").hide();
            })

            // when form is submit

        })
    </script>
@endsection


