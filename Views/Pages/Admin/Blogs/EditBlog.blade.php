@extends("Layouts.main")

@section("title")
    Admin Panel Edit Article {{$article->title}}
@endsection()

@section("content")
    @include("Includes.AdminNav")
    @isset($message){{$message}}@endisset
    @isset($values)
        @foreach($values as $value)
            Missing {{$value}}
        @endforeach
    @endisset
    <div class="head">Edit a new Article</div>


    <form action="{{$url->make("admin.articles.update")}}" method="post" enctype="multipart/form-data">
        {{csrf()}}
        <input type="hidden" name="id" value="@isset($article){{$article->id}}@endisset">
        <div class="form-group">
            <label for="title">Article Title</label>
            <input type="text" class="form-control" name="title" value="@isset($article){{$article->title}}@endisset">
        </div>
        <div class="form-group">
            <textarea name="content" id="" cols="30" rows="10" class="form-control">@isset($article){{$article->content}}@endisset</textarea>
        </div>

        <div>
            Tick the following box if you wish to add images : <input type="checkbox" class="toggle_check" name="images" value="1">
            <div class="row toggled_content">
                @for($i=0;$i<5;$i++)
                    <hr>
                <input type="file" class="form-control" name="upload[]" multiple>
                Description
                <hr>
                <textarea name="description" id="editor" cols="30" rows="10"
                          class="form-control">@isset($image){{$image->description}}@endisset</textarea>
                    <hr>
                    @endfor
            </div>
        <div class="form-group text-right">
            <button class="btn btn-primary">Update Page</button>
        </div>
    </form>

    <form action="{{$url->make("admin.articles.images.delete")}}" method="post">
        @if($images->count() == 0)
            <div class="row">
                <div class="col-sm-12">This Page does not contain any images </div>
            </div>
        @else
            <input type="checkbox" id="checkall">
            @foreach($images as $image)
                <div class="row my-1">

                    <div class="col-sm-"><img src="/img/uploads/{{$image->image_name}}" height="100" width="100" alt=""></div>
                    <div class="col-sm-9 text-center py-3">Image id : {{$image->id}}<input type="checkbox" name="id[]" value="@isset($image){{$image->id}}@endisset"></div>
                </div>
            @endforeach
        {!! $links !!}
            <div class="row">
                <div class="col-sm-12"><button class="btn btn-primary">Delete</button></div>
            </div>
        @endif
    </form>
@endsection