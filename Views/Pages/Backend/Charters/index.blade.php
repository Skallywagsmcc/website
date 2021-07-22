@extends("Layouts.backend")

@section("title")
    List  Charters
    @endsection

@section("content")

    <div class="container">
        @isset($error)
            <div class="bg-danger">
                {{$error}}
            </div>

        @endisset
        Welcome to the Charters <a href="{{$url->make("auth.admin.charters.create")}}">Add New Charter</a> <br>

        @foreach($charters as $charter)
            {{$charter->title}}  | <a href="{{$url->make("auth.admin.charters.edit",["id"=>base64_encode($charter->id)])}}">Edit Charter</a>
            <a href="{{$url->make("auth.sadmin.charters.delete",["id"=>base64_encode($charter->id)])}}">Delete Article</a>

            <br>
        @endforeach
    </div>

@endsection