@extends("Layouts.main")

@section("content")

    <div class="container">

        @if($expired == false)
            <div class="row">
                <div class="col-sm-12 head">@isset($message){{$message}}@endisset</div>
                <div class="col-sm-12">
                    <form action="{{$url->make("password-reset.store")}}" method="post" class="tld-form">
                        <input type="hidden" name="id" value="{{$id}}">
                        <input type="hidden" name="hex" value="{{$hex}}">
                        Password : <input type="password" class="form-control tld-input" name="password"> <br><br>
                        Password Confirm : <input type="password" class="form-control tld-input"  name="confirm"><br><br>
                        <button>Save</button>
                    </form>
                </div>
            </div>

        @else
            @isset($message)
                <div class="alert-danger py-1 my-1 text-center">
                    {{$message}} <a class="text-black-50" href="{{$url->make("homepage")}}">Go Back to the homepage</a>
                </div>
            @endisset

        @endif
    </div>

@endsection