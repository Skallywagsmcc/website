@extends("Layouts.main")

@section("title")
    Admin Panel New Article
    @endsection()

@section("content")
<h6>Create a new Article</h6>
{{$message}}
@isset($values)
@foreach($values as $value)
    Missing {{$value}}
    @endforeach
@endisset
    <form action="/admin/blog/new" method="post">
{{--        Add Categories here --}}
        <input type="text" name="title" value="{{$blog->title}}" placeholder="Article title">
        <textarea name="content" id="" cols="30" rows="10"></textarea>
        <button>Save</button>
    </form>

    here we will create a new article.
@endsection