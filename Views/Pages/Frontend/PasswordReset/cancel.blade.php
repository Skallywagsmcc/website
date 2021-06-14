@extends("Layouts.main");

@section("title")
    Cancel Password Request.
@endsection
@section("content")
    <div class="container">
        @isset($message){{$message}}@endisset
        <div class="row">
            <form action="{{$url->make("password.cancel.store")}}" method="post">
                <input type="text" name="id" value="@isset($id){{$id}}@endisset">
                <input type="text" name="exchange_key" value="@isset($key){{$key}}@endisset" class="form-control">
                <button class="btn btn-primary btn-block">Submit Request</button>
            </form>
        </div>
    </div>
    @endsection