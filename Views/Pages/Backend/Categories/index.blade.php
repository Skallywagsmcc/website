@extends("Layouts.main")
@section("title")
@endsection()

@section("content")
    <a href="{{$url->make("admin.category.create")}}">New Category</a>
    <div class="row text-center">
        <div class="col-md-3">Category title</div>
        <div class="col-md-3">Category SLug</div>
        <div class="col-md-6">Category Options</div>
    </div>
    @foreach($categories as $category)
        <div class="row">
            <div class="col-md-6">{{$category->title}}</div>
            <div class="col-md-3"><a href="{{$url->make("pages.home",["category"=>$category->slug])}}">{{$category->slug}}</a></div>
            <div class="col-md-3"><a href="{{$url->make("admin.category.delete",["id"=>base64_encode($category->id)])}}">Delete</a></div>
        </div>
    @endforeach
@endsection()