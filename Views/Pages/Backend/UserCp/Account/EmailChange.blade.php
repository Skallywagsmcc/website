@extends("Layouts.backend")

@section("content")
    <div class="row p-0">
        @include("Includes.Backend.SecuritySidebar")

        <div class="col-sm-2 col-md-9">
            {{--        <div class="row d-flex justify-content-center">--}}
            {{--            <div class="col-sm-12 head text-md-left text-center">Welcome</div>--}}
            {{--            <div class="col-sm-12 info text-center">This isn the new Account panel</div>--}}
            {{--        </div>--}}
            {{--        <div class="alert-dark">@isset($error)--}}
            {{--                Error says : {{$error}}--}}
            {{--            @endisset</div>--}}
            {{--        <hr>--}}
            <form action="{{$url->make("account.email.store")}}" method="post">
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
    {{--    the profile information will show down here.--}}

@endsection