@extends("Layouts.main")
@section("title")
    Skallywagsmcc Articles
@endsection

@section("content")
    @if($articles->count() >= 1)
        <div class="container my-2">
            <div class="row">
                <div class="col-sm-12 col-lg-8">
                    @foreach($articles as $article)
                        <div class="my-2">
                            <div class="col sm-12 head text-center text-lg-left pl-lg-2">@isset($article){{$article->title}}@endisset</div>
                            <div class="col-sm-12">@isset($article){{substr($article->content,0,200)}}@endisset</div>
                            <div class="row border-top border-dark my-2 mx-0">
                                <div class="col-sm-12 col-lg-4 text-center text-lg-left pl-lg-1 py-2">
                                    @if($article->created_at == $article->updated_at)
                                        Created
                                        {{date("d/m/Y",strtotime($article->created_at))}}
                                    @else
                                        Updated
                                        : {{date("H:i",strtotime($article->updated_at))}} {{date("d/m/Y",strtotime($article->updated_at))}}
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4 text-center py-2">Posted By :
                                    <a href="{{$url->make("profile.view",["username"=>$article->user->username])}}">
                                        {{ucfirst($article->user->Fullname($article->user_id))}}
                                            </a>
                                </div>
                                <div class="col-sm-12 col-lg-4 text-center text-lg-right pr-lg-2">
                                    <a href="{{$url->make("articles.view",["slug"=>$article->slug])}}"
                                       class="d-block py-2">View
                                        Article</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="col-sm-12 col-lg-4">
                    <div class="my-2">
                        <div class="col-sm-12 head text-center text-lg-left pl-lg-2">
                            Articles By year
                        </div>
                        @foreach($years as $year)
                            <div class="col-sm-12 text-center py-2">
                                <a href="{{$url->make("articles.year",["year"=>$year->year])}}"
                                   class="d-block">  {{$year->year}}</a>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    @else
        <div class="container my-2">
            <div class="row">
                <div class="col sm-12 head text-center text-lg-left pl-lg-2">No Article Loaded</div>
                <div class="col-sm-12">Sorry ! it seems that no articles have been found, Please try again another
                    time.
                </div>
            </div>
        </div>
    @endif
@endsection