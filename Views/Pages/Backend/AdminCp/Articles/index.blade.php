@extends("Layouts.backend")

@section("tite")
    Admin Panel : Blogs
@endsection
@section("content")
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center text-md-left pl-md-1 py-2">
                <a href="{{$url->make("auth.admin.home")}}">Back to admin home</a>
            </div>
        </div>
    </div>

    <div class="container">

        <form action="{{$url->make("auth.admin.articles.search")}}" class="tld-form">
            <div class="form-row">
                <div class="col-sm-12 col-md-9 my-3">
                    <input type="search" class="form-control tld-input" name="keyword" placeholder="Search for a user">
                </div>
                <div class="col-sm-12 col-md-3 my-3 ">
                    <button class="btn btn-block btn-dark">Search</button>
                </div>
            </div>
        </form>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 box text-center py-2 my-2 text-md-right pr-lg-2">
                <a href="{{$url->make("auth.admin.articles.new")}}">Create an Article</a>
            </div>
        </div>
    </div>


    <div class="container d-none d-md-block">
        <div class="row box head py-2 my-2 text-center">
            <div class="col-md-6">Article title</div>
            <div class="col-md-6">Article Options</div>
        </div>
    </div>

    <div class="container text-center">
        @foreach($articles as $article)
        <div class="row box my-md-0 my-2">
            <div class="col-sm-12 col-md-6 py-2">{{$article->title}}</div>
            <div class="col-sm-12 col-md-2 py-2">
                <a class="d-block" href="{{$url->make("articles.view",["category"=>$article->category->slug,"slug"=>$article->slug])}}" target="_new">View Article</a>
            </div>
            <div class="col-sm-12 col-md-2 py-2 "><a class="d-block" href="{{$url->make("auth.admin.articles.edit",["slug"=>$article->slug,"id"=>base64_encode($article->id)])}}">Edit Article</a></div>
            <div class="col-sm-12 col-md-2 py-2"><a class="d-block" href="{{$url->make("auth.admin.articles.delete",["id"=>base64_encode($article->id)])}}">Delete Article</a></div>
        </div>
        @endforeach
    </div>

@endsection