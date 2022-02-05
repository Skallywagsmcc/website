@extends("Layouts.Themes.BaseGrey.Admin")

@section("title")
@endsection

@section("content")

    @isset($request)


        @if($status == true)
            Registration is Open to the public
        @else

            @isset($request->error)
                <div class="container-fluid my-2">
                    <div class="row box">
                        <div class="col-sm-12 head">An Error Occurred</div>
                        <div class="col-sm-12 py-2 text-center">
                            {{$request->error}}
                        </div>
                    </div>
                </div>

            @endisset
            <div class="container-fluid my-2">
                <div class="row box">
                    <div class="col-sm-12 head py-2">Private Registration : User Creation</div>
                </div>
            </div>
            <div class="container-fluid my-2">
                <div class="row">
                    <div class="col-sm-12 box py-2">
                        <form action="{{$url->make("auth.admin.users.store")}}" method="post" class="tld-form">
                            {{csrf()}}
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="first_name">First name : </label>
                                    <input type="text" class="form-control tld-input" name="first_name"
                                           value="@isset($request){{$request->first_name}} @endisset">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="last_name">Last name : </label>
                                    <input type="text" class="form-control tld-input" name="last_name"
                                           value="@isset($request){{$request->last_name}} @endisset">
                                </div>
                            </div>

                            <div class="form-row">
                                <label for="email">Email Address : </label>
                                <input type="text" class="form-control tld-input" name="email"
                                       value="@isset($request){{$request->email}}@endisset"/>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <h2>Other Settings</h2>
                                    <label for="is_admin">Set this user as Administrator</label>
                                </div>
                                <div class="col-sm-12">
                                    <input type="checkbox" name="is_admin" @isset($request->is_admin) checked @endisset value="1">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <h2>Other Settings</h2>
                                    <label for="is_admin">Set this user as Crew Member</label>
                                </div>
                                <div class="col-sm-12">
                                    <input type="checkbox" name="is_crew"  @isset($request->is_crew) checked @endisset  value="1">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <label for="admin_password">Your Admin Password</label>
                                </div>
                                <div class="col-sm-12 my-2 py-2">
                                    <input type="password" class="form-control px-1" name="admin_password">
                                </div>
                            </div>

                            <div class="form-group text-right">
                                <button class="btn btn-primary btn-block">Create User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
       @endif
    @endisset


@endsection

