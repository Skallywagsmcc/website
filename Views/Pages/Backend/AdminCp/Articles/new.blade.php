@extends("Layouts.backend")

@section("title")
    Admin Panel New Article
@endsection()

@section("content")

    <div class="container">
        {{--   Do Error handling here.--}}
        @isset($error)
            <div class="row">
                <div class="col-sm-12">{{$error}}</div>
            </div>

                @isset($rmf)
                    @foreach($rmf as $required)
                        <div class="col-sm-12">{{$required}}</div>
                    @endforeach
                @endisset

        @endisset
    </div>
    <div class="container">
        <div class="row box">
            <div class="col-sm-12 head py-2 text-center">Create a new Article</div>
        </div>
    </div>
    <div class="container my-2">
        <div class="row">
            <div class="col-sm-12 box py-2">
                <form action="{{$url->make("auth.admin.articles.store")}}" method="post" enctype="multipart/form-data">
                    {{csrf()}}
                    <div class="form-group">
                        <label for="title">Article Title</label>
                        <input type="text" class="form-control tld-input" name="title" value="">
                    </div>
                    <div class="form-group">
            <textarea name="Content" class="form-control tld-input" required></textarea>
                    </div>

                    <div class="row">
                        <div class="col-sm-12"><input type="file" name="thumb"></div>
                    </div>
                    <div class="form-group text-right">
                        <button class="btn btn-primary">Create Page</button>
                    </div>
            </div>

            </form>
        </div>
    </div>
    </div>


@endsection