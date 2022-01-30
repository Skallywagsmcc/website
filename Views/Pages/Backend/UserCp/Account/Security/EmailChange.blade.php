@extends("Layouts.Themes.BaseGrey.Account")
@section("title")
    Security : Change Email
@endsection
@section("content")

    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center text-md-left pl-md-1"><a href="{{$url->make("security.home")}}">Back to Security Home</a></div>
        </div>
    </div>


    @isset($error)
        <div class="container my-2">
            <div class="alert-dark">Error says : {{$error}}</div>
        </div>
    @endisset


    <div class="container my-2">
        <div class="row box">
            <div class="col-sm-12 py-2 head">Update Email Address</div>
        </div>
    </div>

    <div class="container my-2">
        <div class="row box">
            <div class="col-sm-12 py-2">
                <form action="{{$url->make("security.email.store")}}" method="post">
                    {{csrf()}}
                    <div class="form-row my-2">
                        <div class="col-sm-12 col-md-3 py-1 pr-md-2 text-center text-md-right ">
                            <label for="email">Your Email Address</label>
                        </div>
                        <div class="col-sm-12 col-md-9">
                            <input type="email" name="email" class="form-control"
                                   value="@isset($post){{$post->email}}@else{{$user->email}}@endisset">
                        </div>

                    </div>
                    <div class="form-row my-2">
                        <div class="col-sm-12 col-md-3 text-center text-md-right pr-md-2 py-1 ">Your Password</div>
                        <div class="col-sm-12 col-md-9 px-2"><input type="password" name="password"
                                                                    class="form-control"/></div>
                    </div>
                    <button class="btn btn-block btn-dark">update Password</button>
                </form>
            </div>

        </div>
    </div>

    {{--  Refactor Complete on 15/11/2021--}}

@endsection