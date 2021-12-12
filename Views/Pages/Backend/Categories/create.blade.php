@extends("Layouts.Themes.BaseGrey.Admin")

@section("title")
@endsection()

@section("content")
    <form action="{{$url->make("admin.category.store")}}" method="post">
        {{Csrf()}}
        <div class="form-group">
            <input type="text" class="form-control" name="title" value="{{$category->title}}">
        </div>
        <button class="btn btn-primary">Save</button>
    </form>
@endsection()