@extends("Layouts.main");

@section("tite")
    Admin Panel : Blogs
@endsection
@section("content")
    <h6>Blogs <a href="/admin/blog/new">Create a new Blog</a></h6>
    @foreach($blogs as $blog)
        {{$blog->title}}  | {{ $blog->slug }} | <a href="/admin/blog/edit/{{$blog->id}}">Edit</a> | <a href="/admin/blog/edit/delete/{{$blog->id}}">Delete</a>
        <br>
        @endforeach
@endsection