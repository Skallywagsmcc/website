@extends("Layouts.backend")

@section("tite")
    Admin Panel : Blogs
@endsection
@section("content")
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
        {{--        Admin Articles List goes here--}}
        <div class="row">
            <div class="col-md-3">
                {{--            Navbar goes here--}}
                <a href="{{$url->make("auth.admin.articles.new")}}">New Page</a>
            </div>
            <div class="col-md-9">
                <div class="row text-center head">
                    <div class="col-md-6">Article title</div>
                    <div class="col-md-6">Article Options</div>
                </div>
                @foreach($articles as $article)
                    <div class="row text-center  m-2 mx-md-0 p-2 article-row">
                        <div class="col-md-6">{{$article->title}}</div>
                        <div class="col-md-2"><a
                                    href="{{$url->make("articles.view",["category"=>$article->category->slug,"slug"=>$article->slug])}}"
                                    target="_new">View Article</a></div>
                        <div class="col-md-2"><a
                                    href="{{$url->make("auth.admin.articles.edit",["slug"=>$article->slug,"id"=>base64_encode($article->id)])}}">Edit
                                Article</a></div>
                        <div class="col-md-2"><a
                                    href="{{$url->make("auth.admin.articles.delete",["id"=>base64_encode($article->id)])}}">Delete
                                Article</a></div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>

@endsection