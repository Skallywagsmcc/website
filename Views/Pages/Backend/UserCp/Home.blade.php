@extends("Layouts.Themes.BaseGrey.Account")
@section("title")
    Backend Control panel : Home
@endsection

@section("content")

    @if($request->activity->count() >= 1)

        @foreach($request->activity as $activity)
            @if($activity->entity_name == "page/contact")
                @if($activity->role == "create")
                    You created a contact page
                @endif
            @endif
        @endforeach
    @else
        No Results found;
    @endif
    <div class="container my-2">
        <div class="row box">
            <div class="col-sm-12 head">Welcome to your User Account</div>
            <div class="col-sm-12">Welcome to the User Account Section this Section is currently empty and will
                eventually be added
                to Please use the Links to the left in desktop mode or by pressing menu button to navigate the website,
                <br> Some features are still being worked on and will are being added slowly
            </div>
        </div>
    </div>


@endsection