@extends("Layouts.main")
@section("content")
<div class="container">
    <div class="row">
        <div class="col-sm-12 head">An Error Occurred</div>
        @isset($error)
        <div class="col-sm-12 text-center">{{$error}}</div>
        @endisset
        <div class="col-sm-12 py-2 text-center"><a href="{{$link}}" class="d-block">{{$linktitle}}</a></div>
    </div>
</div>
@endsection()