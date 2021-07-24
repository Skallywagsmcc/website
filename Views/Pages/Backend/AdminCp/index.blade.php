@extends("Layouts.backend")

@section("title")
    Admin Panel : Home
@endsection

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-4">
                {{--            Count users --}}
                <div class="col-sm-12 px-5 bg-primary text-center">
                    <h2>{{$users->count()}} Users</h2>
                </div>
                <a href="{{$url->make("auth.admin.users.home")}}" class="d-block text-center">Manage Users</a>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="col-sm-12 px-5 bg-primary text-center">
                    <h2>{{$articles->count()}} Articles</h2>
                </div>
                <a href="{{$url->make("auth.admin.articles.home")}}" class="d-block text-center">Manage Articles</a>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="col-sm-12 px-5 bg-primary text-center">
                    <h2>{{$events->count()}} Events</h2>
                </div>
                <a href="{{$url->make("auth.admin.events.home")}}" class="d-block text-center">Manage Articles</a>
            </div>

            <div class="col-sm-12 col-md-4">
                <div class="col-sm-12 px-5 bg-primary text-center">
                    <h2>{{$charters->count()}} charters</h2>
                </div>
                <a href="{{$url->make("auth.admin.charters.home")}}" class="d-block text-center">Manage charters</a>
            </div>

            <div class="col-sm-12 col-md-8">
                <div class="col-sm-12 px-5 bg-primary text-center">
                    <h2>{{$images->count()}} Image Uploads</h2>
                </div>
                <a href="{{$url->make("auth.admin.images.home")}}" class="d-block text-center">Manage Images</a>
            </div>

{{--            <div class="col-sm-12 col-md-4">--}}
{{--                <div class="col-sm-12 px-5 bg-primary text-center">--}}
{{--                    <h2>{{$comments->count()}} Comments</h2>--}}
{{--                </div>--}}
{{--                <a href="{{$url->make("auth.admin.charters.home")}}" class="d-block text-center">Manage Comments</a>--}}
{{--            </div>--}}

            <div class="col-sm-12 col-md-4">
                <div class="col-sm-12 px-5 bg-primary text-center">
                    <h2>{{$comments->count()}} Members</h2>
                </div>
                <a href="{{$url->make("auth.admin.charters.home")}}" class="d-block text-center">Manage Members</a>
            </div>

            <div class="col-sm-12 col-md-8">
                <div class="col-sm-12 px-5 bg-primary text-center">
                    <h2>{{$comments->count()}} Featured Image Requests</h2>
                </div>
                <a href="{{$url->make("auth.admin.charters.home")}}" class="d-block text-center">Manage Featueedd Image Requersts</a>
            </div>
        </div>
    </div>

@endsection
