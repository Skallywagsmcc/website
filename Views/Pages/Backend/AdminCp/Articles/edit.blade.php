@extends("Layouts.backend")

@section("title")
    Admin Panel Edit Article {{$article->title}}
@endsection()

@section("content")
    @isset($message){{$message}}@endisset
    @isset($values)
        <div class="container">
            <div class="row box">
                <div class="col-sm-12 head py-2">An Error Occurred</div>
            </div>
        </div>
        <div class="container text-center">
            <div class="row box">
                @foreach($values as $value)
                    <div class="col-sm-12 py-2">
                        Missing {{$value}}
                    </div>
                @endforeach
            </div>
        </div>

    @endisset
    <div class="container">
        <div class="row box text-center">
            <div class="col-sm-12 py-2 head">Edit Article</div>
        </div>
    </div>
    <div class="container my-2">
        <div class="row box">
            <div class="col-sm-12 py-2">
                <form action="{{$url->make("auth.admin.articles.update")}}" method="post" enctype="multipart/form-data">
                    {{csrf()}}
                    <input type="hidden" name="id" value="@isset($article){{$article->id}} @endisset">
                    <div class="form-group">
                        <label for="title">Article Title</label>
                        <input type="text" class="form-control tld-input" name="title" value="@isset($article){{$article->title}}@endisset">
                    </div>
                    <div class="form-group">
                <textarea name="content" id="" cols="30" rows="10"
                          class="form-control tld-input">@isset($article){{$article->content}}@endisset</textarea>
                    </div>

                    <div>
                        Tick the following box if you wish to add images : <input type="checkbox" class="toggle_check"
                                                                                  name="images" value="1">
                        <div class="row toggled_content">
                            @for($i=0;$i<5;$i++)
                                <hr>
                                <input type="file" class="form-control tld-input" name="upload[]" multiple>
                                Description
                                <hr>
                                <textarea name="description" id="editor" cols="30" rows="10"
                                          class="form-control tld-input">@isset($image){{$image->description}}@endisset</textarea>
                                <hr>
                            @endfor
                        </div>
                        <div class="form-group text-right">
                            <button class="btn btn-primary">Update Page</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection