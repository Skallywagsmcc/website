<div class="row">
    <div class="col-sm-12 text-right">
        <a href="{{$url->make("homepage")}}">Cancel Login and back to make site</a>
    </div>
    <div class="logo_wrapper my-1 text-center col-sm-12">
        <img src="/img/logo.png" height="200px" width="200px" alt="">
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <form action="{{$url->make("login.store")}}" method="post" class="tld-form">
            <div class="form-group tld-form">
                <label for="username">Your Username/Email Address</label>
                <input type="text" name="username" class=" form-control tld-input" placeholder="Email Address or username">
            </div>
            {{--            Password--}}
            <div class="form-group">
                <label for="password">Your Password</label>
                <input type="password" name="password" class="form-control tld-input" placeholder="Password">
            </div>
            <div class="form-row my-1">
                <div class="col-sm-6 text-md-right text-center">
                    <label for="remember">Remember Me for 7 days</label>
                </div>
                <div class="col-sm-6 text-center">
                    <input type="checkbox" name="remember" class="tld-input">
                </div>
                <button class="btn btn-block tld-button my-2">Login</button>
            </div>

        </form>

    </div>
</div>

<div class="footer text-center row">
    <div class="col-sm-12 col-md-12 py-1"><a href="{{$url->make("password-reset.index")}}">Help logging in</a></div>
{{--    <div class="col-sm-12 col-md-6 py-1">Register</div>--}}

</div>
