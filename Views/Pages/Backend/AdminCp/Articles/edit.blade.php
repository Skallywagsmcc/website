@extends("Layouts.backend")

@section("title")
    Admin Panel Edit Article {{$article->title}}
@endsection()

@section("content")

    <div class="container">
        <div class="row box text-center">
            <div class="col-sm-12 py-2 head">Edit Article</div>
        </div>
    </div>
    <div class="container my-2">
        <div class="row box">
            <div class="col-sm-12 py-2">
                <form action="{{$url->make("auth.admin.articles.update",["slug"=>$article->slug,"id"=>base64_encode($article->id)])}}" method="post" enctype="multipart/form-data">
                    {{csrf()}}
                    <input type="hidden" name="id" value="@isset($article){{$article->id}} @endisset">
                    <div class="form-group">
                        <label class="font-weight-bolder tu py-2 my-1" for="title">Article Title
                            @isset($post)
                                @if(empty($post->title))
                                 : this field is required and cannot be empty
                                @endif
                            @endisset
                        </label>
                        <input type="text" class="form-control tld-input" name="title" value="@isset($post){{$post->title}}@else{{$article->title}}@endisset">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bolder tu py-2 my-1" for="title">Article Content
                            @isset($post)
                                @if(empty($post->content))
                                    : this field is required and cannot be empty
                                @endif
                            @endisset
                        </label>
                <textarea name="content" id="" cols="30" rows="10"
                          class="form-control tld-input">@isset($post){{$post->content}}@else{{$article->content}}@endisset</textarea>
                    </div>

                        <div class="form-group text-right">
                            <button class="btn btn-primary btn-block my-2">Update Page</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection