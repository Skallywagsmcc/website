@extends("Layouts.main")

@section("content")
    <div class="container my-2">
        <div class="row">
            <div class="col-sm-12">
                <form action="{{$url->make("search.view")}}" method="get" class="tld-form">
                    <input type="text" name="keyword" class="tld-input form-control my-2"
                           placeholder="Search for Users, Articles ,Charters or Events">
                    <button class="tld-button btn-block btn">Search</button>
                </form>
            </div>
        </div>
    </div>
@endsection