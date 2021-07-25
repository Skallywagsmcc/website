@extends("Layouts.backend")
@section("title")
    Security : Change Email
@endsection
@section("content")
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="head">Update My email Address</div>
                <form action="{{$url->make("security.email.store")}}" method="post" class="info">
                    {{csrf()}}
                    Your email
                    <input type="email" name="email" value="@isset($user){{$user->email}}@endisset">
                    <hr class="text-white">
                    Your password
                    <input type="password" name="password"/>
                    <button>update Password</button>
                </form>
            </div>

        </div>
    </div>

    {{--    the profile information will show down here.--}}

@endsection