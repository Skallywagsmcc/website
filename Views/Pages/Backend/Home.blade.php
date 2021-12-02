@extends("Layouts.Themes.Backend.default")

@section("title")
    Backend Control panel : Home
@endsection

@section("content")
    <div class="container block">
        <div class="row">
            <div class="col sm-12 col-md-6 prevbtn"><a href="#">back</a></div>
            <div class="col sm-12 col-md-6 nextbtn"><a href="#">next</a></div>
        </div>

        <div class="col-sm-12 my-3">
            <div class="head">Beta Updates</div>
            <div class="info">
                <div>This is a temporary section</div>
                <div>This section is currently under development and going through a migration process some things may
                    change before final release
                </div>
            </div>
        </div>
    </div>

    <div class="container block">
        <div class="row">
            <div class="col sm-12 col-md-6 prevbtn"><a href="#">back</a></div>
            <div class="col sm-12 col-md-6 nextbtn"><a href="#">next</a></div>
        </div>

        <div class="col-sm-12 my-3">
            <div class="head">My Activity</div>
            <div class="info">
                Section Coming soon
            </div>
        </div>
    </div>


@endsection