@extends("Layouts.backend")

@section("title")
    Admin Panel New Article
@endsection()

@section("content")

    <div class="container">
       @isset($message) {{$message}}@endisset
        @isset($values)
            @foreach($values as $value)
                Missing {{$value}}
            @endforeach
        @endisset
        <div class="head">Create a new Article</div>
        <form action="{{$url->make("auth.admin.articles.store")}}" method="post" enctype="multipart/form-data">
            {{csrf()}}
            <div class="form-group">
                <label for="title">Article Title</label>
                <input type="text" class="form-control tld-input" name="title" value="@isset($article){{$article->title}}@endisset">
            </div>
            <div class="form-group">
            <textarea name="content" id="editor" cols="30" rows="10"
                      class="form-control tld-input">@isset($article){{$article->content}}@endisset</textarea>
            </div>
            <div>
                Tick the following box if you wish to add images : <input type="checkbox" class="toggle_check" name="images"
                                                                          value="1">
                <div class="row toggled_content">
                    <input type="file" class="form-control tld-input" name="upload[]" multiple>
                    Description
                    <hr>
                    <textarea name="description" id="editor" cols="30" rows="10"
                              class="form-control tld-input">@isset($image){{$image->description}}@endisset</textarea>
                </div>
                <div class="form-group text-right">
                    <button class="btn btn-primary">Create Page</button>
                </div>
            </div>

        </form>

    </div>
   @endsection