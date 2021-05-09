@extends("Layouts.main")

@section("title")
    Contact us
@endsection

@section("content")
    <form action="{{$url->make("contact-store")}}" method="post">
        <div class="row">
            <div class="col-sm-12 head">Contact us</div>
        </div>
        <div class="form row">
            <div class="form-group col-md-6">
                <label for="">Email Address:</label>
                <input type="text" class="form-control" name="email">
            </div>

            <div class="form-group col-md-6">
                <label for="">First Name :</label>
                <input type="text" class="form-control" name="first_name">
            </div>

            <div class="form-group col-md-6">
                <label for="">Last Name :</label>
                <input type="text" class="form-control" name="last_name">
            </div>
        </div>

        <div class="form-group">
            <input type="text" class="form-control" name="subject">
        </div>
        
        <div class="form-group">
            <label for="message">Your Message </label>
            <textarea name="" id="message" name="message" class="form-control"></textarea>
        </div>

        <button class="btn btn-primary btn-block">Send message</button>
    </form>
@endsection
