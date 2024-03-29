@extends("Layouts.Themes.BaseGrey.Admin")
@section("title")
    List  Charters
    @endsection

@section("content")

    <div class="container">
        @isset($error)
            <div class="bg-danger">
                {{$error}}
            </div>

        @endisset

            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center text-md-left pl-md-1 py-2">
                        <a href="{{$url->make("auth.admin.home")}}">Back to admin home</a>
                    </div>
                </div>
            </div>

            <div class="row box border border-dark">
                <div class="col-sm-12 text-center text-md-right pr-md-2 py-2"><a href="{{$url->make("auth.admin.charters.create")}}">Add New Charter</a></div>
            </div>
            <form action="{{$url->make("auth.admin.charters.default")}}" method="post">
                @foreach($charters as $charter)
                    <div class="row my-1 box text-center py-2">
                        <div class="col-sm-12 col-md-6">
                            {{$charter->title}}
                        </div>
                        <div class="col-sm-12 col-lg-3"><a href="{{$url->make("auth.admin.charters.edit",["id"=>base64_encode($charter->id)])}}">Edit Charter</a></div>
                        <div class="col-sm-12 col-lg-3"><a href="{{$url->make("auth.admin.charters.delete",["id"=>base64_encode($charter->id)])}}">Delete Article</a></div>
                    </div>
                @endforeach

            </form>

    </div>

    @if($request->AllResources($request->entity_name)->count() == 0)
        No Resources Found
            @else
                @foreach($requests->AllResources($request->entity_name) as $resources)
                    {{$resources->value}}
                @endforeach
        @endif

@endsection