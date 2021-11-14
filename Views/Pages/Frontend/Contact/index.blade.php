@extends("Layouts.main")

@section("title")
    Contact us
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
                        <form action="{{$url->make("contact-store")}}" class="tld-form" method="post">
                            <div class="row">
                                <div class="col-sm-12 head">Contact us</div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address:</label>
                                <input type="text" class="form-control tld-input" name="email"
                                       value="@isset($requests){{$requests->email}}@endisset">
                            </div>

                            <div class="form row">
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
                            <div class="form-group">
                                <label for="subject">Club Name if Applicable</label>
                                <input type="text" class="form-control tld-input" name="club"
                                       value="@isset($requests){{$requests->club}}@endisset">
                            </div>

                            <hr>
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input type="text" class="form-control tld-input" name="subject"
                                       value="@isset($requests){{$requests->subject}}@endisset">
                            </div>


                            <div class="form-group">
                                <label for="message">Your Message </label>
                                <textarea id="message" name="message"
                                          class="form-control tld-input">@isset($requests){{$requests->message}}@endisset</textarea>
                            </div>


                            <div class="form-group mx-0">
                                <input type="hidden" name="sum1" value="{{$sum1}}">
                                <input type="hidden" name="sum2" value="{{$sum2}}">
                                <div class="col-sm-12 py-2 text-left pl-lg-1">
                                    <label for="sum">What is : {{$sum1}} + {{$sum2}} ? (Answer Below)</label>
                                </div>
                                <div class=" col-sm-12">
                                    <input type="text" class="form-control tld-input" name="total">
                                </div>


                            </div>

                            <button class="btn tld-button btn-block">Send message</button>
                        </form>

                    </div>
                    <div class="col-sm-12 col-lg-4 my-3 my-lg-0">
                        @isset($requests)
                            <div class="col-sm-12 head">Contact informtion</div>
                            <div class="col-sm-12 text-center">
                                Telehone Number :
                                @if(!empty($requests->settings->first()->contact_telephone))
                                    0{{$requests->settings->first()->contact_telephone}}
                                @else
                                    Not Provided
                                @endif
                            </div>

                            <div class="col-sm-12 head">Email Address</div>
                            <div class="col-sm-12 text-center">
                                Email Address :
                                @if(!empty($requests->settings->first()->contact_email))
                                    0{{$requests->settings->first()->contact_email}}
                                @else
                                    No Email Added
                                @endif
                            </div>
                        @endisset
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
@endsection
