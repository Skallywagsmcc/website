@extends("Layouts.main")

@section("title")
    Contact us
@endsection

@section("content")
    <div class="container">
        @isset($error)
            @if($error == "required")
                @foreach($validate::$values as $value)
                    Missing Value :: {{$value}} <br>
                @endforeach
            @else
                {{$error}}
            @endif
        @endisset
        <form action="{{$url->make("contact-store")}}" method="post">
            <div class="row">
                <div class="col-sm-12 head">Contact us</div>
            </div>
            <div class="form-group col-md-6">
                <label for="email">Email Address:</label>
                <input type="text" class="form-control" name="email" value="@isset($validate){{$validate->Post("email")}}@endisset">
            </div>

            <div class="form row">


                <div class="form-group col-md-6">
                    <label for="">First Name :</label>
                    <input type="text" class="form-control" name="first_name" value="@isset($validate){{$validate->Post("first_name")}}@endisset">
                </div>

                <div class="form-group col-md-6">
                    <label for="">Last Name :</label>
                    <input type="text" class="form-control" name="last_name" value="@isset($validate){{$validate->Post("last_name")}}@endisset">
                </div>
            </div>

            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" class="form-control" name="subject" value="@isset($validate){{$validate->Post("subject")}}@endisset">
            </div>

            <div class="form-group">
                <label for="message">Your Message </label>
                <textarea id="message" name="message" class="form-control">@isset($validate){{$validate->Post("message")}}@endisset</textarea>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-12 col-md-7 py-2 text-right">
                    <input type="hidden" name="sum1" value="{{$sum1}}">
                    <input type="hidden" name="sum2" value="{{$sum2}}">
                    <label for="sum">What is : {{$sum1}} + {{$sum2}} ?</label>
                </div>
                <div class="form-group col-sm-12 col-md-5 text-left">
                    <input type="text" class="form-control" name="total">
                </div>


            </div>

            <button class="btn btn-primary btn-block">Send message</button>
        </form>

    </div>
@endsection
