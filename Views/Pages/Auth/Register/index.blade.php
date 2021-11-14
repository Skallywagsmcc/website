@extends("Layouts.main")
@section("content")



    @isset($error)
    <div class="container my-2">
        <div class="row lb2 mx-lg-1">
            <div class="col-sm-12 lb3 text-center text-lg-left pl-lg-1 head">An Error Occurred</div>
            <div class="col-sm-12 text-center">{{$error}}</div>
            @isset($required)
                <ol>
                    @foreach($required as $required)
                        <li class="col-sm-12  text-center text-lg-left pl-lg-1 py-2">
                            {{$required}}
                        </li>
                    @endforeach
                </ol>
            @endisset

            @isset($rfs)
                <ol>
                    @foreach($rfs as $required)
                        <li class="col-sm-12  text-center text-lg-left pl-lg-1 py-2">
                            {{$required}}
                        </li>
                    @endforeach
                </ol>
            @endisset

        </div>
    </div>
    @endisset

    @if($settings->first()->open_registration == 1)

            <div class="container my-2">
                <div class="row my-2 lb3 mx-1">
                    <div class="col-sm-12 head text-center text-lg-left pl-lg-2">Create An Account</div>
                </div>
                <form action="{{$url->make("register.store")}}" method="post" class="tld-form">
                    <div class="form-row">
                        <div class="col-sm-12 mx-3">
                            <label for="username">Username</label>
                        </div>
                        <div class="col-sm-12 mx-3">
                            <input type="text" class="form-control tld-input" name="username" @isset($post)value="{{$post->Post("username")}}"@endisset>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-sm-12 mx-3">
                            <label for="email">Email</label>
                        </div>
                        <div class="col-sm-12 mx-3">
                            <input type="text" class="form-control tld-input" name="email" @isset($post)value="{{$post->Post("email")}}"@endisset>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="col-sm-12">
                                <label for="password">Password</label>
                            </div>
                            <div class="col-sm-12">  <input type="password" class="form-control tld-input" name="password"/></div>
                        </div>

                        <div class="col-sm-12 col-lg-6">
                            <div class="col-sm-12">
                                <label for="confirm">Confirm password</label>
                            </div>
                           <div class="col-sm-12">
                               <input type="password" class="form-control tld-input" name="confirm">
                           </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm-12 mx-3 my-2">
                            <hr>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="col-sm-12"><label for="first_name">First Name </label></div>
                            <div class="col-sm-12"><input type="text"  name="first_name" class="form-control tld-input" @isset($post)value="{{$post->Post("first_name")}}"@endisset></div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="col-sm-12"><label for="last_name">Last Name </label></div>
                            <div class="col-sm-12"><input type="text"  name="last_name" class="form-control tld-input" placeholder="" @isset($post)value="{{$post->Post("last_name")}}"@endisset></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 text-right my-2 mx-3">
                            <button class="btn tld-button btn-block">Create Account</button>
                        </div>
                    </div>
                </form>
            </div>
        @endif


{{--    @if($settings->first()->lock_submissions==1)--}}
{{--        @isset($error)--}}
{{--            @else--}}
{{--        <div class="container my-2">--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-12 head text-center text-lg-left pl-lg-2 lb3">Registration Is locked</div>--}}
{{--                <div class="col-sm-12 text-center my-2 lb2 py-2"> The System has Locked All Form submissions at this time</div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        @endisset--}}
{{--    @else--}}
{{--    @if($or->count()==1)--}}
{{--        <div class="container my-2">--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-12 head text-center text-lg-left pl-lg-2 lb3">Registration Is Closed</div>--}}
{{--                <div class="col-sm-12 text-center my-2 lb2 py-2">Currently Registration is closed to the public, this  website offers and invite only system.--}}
{{--                    <br><br>--}}
{{--                    Already got an Account , <a href="{{$url->make("login")}}">Login</a></div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        @else#--}}

{{--    </div>--}}
{{--    @endif--}}
{{--    @endif--}}

@endsection()