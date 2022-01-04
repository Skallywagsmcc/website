@extends("Layouts.Themes.BaseGrey.Account")

@section("content")
    <div class="row">
        <div class="col-sm-12 col-md-9 my-2">
            <a href="#" id="help-toggle" class="justify-content-md-end d-flex">Show Help</a>
<div id="help" class="mb-4">
    <div class="head d-flex mx-md-3">Help: Uploading a new Profile picture</div>
    <div class="col-sm-12 mb-2">
        Use this feature to change your Profile Picture for your Skallywags account, this can be done as many times as you wish. once Submitted all images are given a unique name in order to prevent our system
        from rejecting your image  if you was to upload a duplicat, images can be deleted from our system and database using the Image Manager in your Account section of the control panel
        <br><br>
        In order to upload an image simply press the choose file option and then press the upload Image button this will then start the upload process and you will then be redirected to the account homepage.
        <br><br>
        please be aware that profile Images are public and therefore we request you keep this image friendly, any images found to break the rules will have there image removed and could lead to your account being terminated
    </div>
</div>

            <div class="container">
                <div class="row col-sm-12 head py-2">Update Profile Picture</div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-sm-12 d-flex justify-content-center">
                        <form action="{{$url->make("account.picture.store")}}" method="post" enctype="multipart/form-data">
                            {{csrf()}}
                            <input type="file" name="upload">
                            <button>Upload</button>
                        </form>
                    </div>
                </div>
            </div>


    {{--    the profile information will show down here.--}}

@endsection