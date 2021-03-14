@extends("Layouts.main")

@section("title")
    Admin Panel New Article
    @endsection()

@section("content")
<h6>Add New Artcle</h6>
{{$message}}
@isset($values)
@foreach($values as $value)
    Missing {{$value}}
    @endforeach
@endisset

@if($count == 1)
    {
    We Found the blog
    }
    @endif
    <form action="/admin/blog/edit" method="post">
{{--        Add Categories here --}}
        <input type="text" name="title" value="{{$blog->title}}" placeholder="Article title">
        <textarea name="content" id="" cols="30" rows="10">
            {{$blog->content}}
        </textarea>
        <button>Save</button>
    </form>

    here we will create a new article.
@endsection