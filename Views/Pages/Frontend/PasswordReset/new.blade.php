@extends("Layouts.main")

@section("content")

<div class="container">

    @if($expired == false)
    <form action="{{$url->make("password-reset.store")}}" method="post">
        <input type="hidden" name="id" value="{{$id}}">
        <input type="hidden" name="hex" value="{{$hex}}">
        Password  : <input type="password" name="password"> <br><br>
        Password Confirm :  <input type="password" name="confirm"><br><br>
        <button>Save</button>
    </form>
        @else
            @isset($message)
                <div class="alert-danger py-1 my-1 text-center">
                    {{$message}}   <a class="text-black-50" href="{{$url->make("homepage")}}">Go Back to the homepage</a>
                </div>
            @endisset

        @endif
</div>

    @endsection