<h1>Welcome to the site : {{$user->username}}</h1>
<br>
We would like to welcome you to the Skallywags Mcc Website your details are as follows

<ol>
    <li>Username : {{$user->username}}</li>
    <li>Email Address : {{$user->email}}</li>
    <li>Your Password : {{$user->password}}</li>
</ol>
<br>
**PLease note that we recommend you change this password when you login  to your account please <a href="{{$_SERVER['DOMAIN']}}/account/edit/password" target="_blank">Click here to change password</a> **
<hr>
When you login to the site You will need either your usernam or email address  followed by your password

please visit the foillowing link to  <a href="{{$_ENV['DOMAIN']}}/auth/login" target="_blank">Login</a> to your account

{{$_ENV["APP_NAME"]}}  {{date('Y')}} &copy;


