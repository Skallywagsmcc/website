adad
@extends("Layouts.main")

@section("content")
<form action="/auth/tfa/approve" method="post">
    <input type="text" name="code" value="" placeholder="Enter your two factor auth code">
    <button>Save</button>
</form>

    <h2>Why two factor authentication</h2>
    As part of our many security implemts that we have added into this website one of those features are 2fa also known as twofacotor authentication
<br>
<br>
    without a two factor authentication you will not be able to Modify your profile, settings or any security based settings in your account, this includes passwords or changing emails.
<br><br>
    Simply obtain the code of your chosen email  account and put the code into the 2fa field and press submit.
@endsection
