@extends("Layouts.main")
@section("title")
@endsection()

@section("content")
    <div class="row text-center">
        <div class="col-md-3">Category title</div>
        <div class="col-md-3">Category SLug</div>
        <div class="col-md-6">Category Options</div>
    </div>
    @foreach($categories as $category)
        <div class="row">
            <div class="col-md-6">{{$category->title}}</div>
        </div>
    @endforeach
@endsection()