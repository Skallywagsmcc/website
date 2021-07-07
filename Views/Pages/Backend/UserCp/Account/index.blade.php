@extends("Layouts.backend")


@section("content")

{{--    Add a welcome $user last logged in at : $time  code here--}}
    <div class="container px-0 px-md-2 my-4">
        <div class="row">
            <div class="col-sm-12  text-center text-md-right">
                <a href="#" class="py-2 px-md-4 " id="help-toggle"></a>
            </div>
        </div>
    </div>


    <div class="container px-0 px-md-2">
        <div class="col-sm-12 px-0" id="help">
            <div class="head px-0">Welcome</div>
            <div class="col-sm-12">
                Welcome to your Personal backend Control Panel, from here you will be able to manage your account details
                with our simple but effective navigation starting from the top Navigation bar.
                <br><br>

                From here you will then be able to access More options using the sidebar (desktop Mode)

                This backend panel uses a mobile first approach and is designed for both desktop and Mobiles in mind,

                welcome to the skallywags Club, and welcome to the family.
            </div>

            <div class="head mt-2">Your Options</div>
            <div class="col-sm-12">the Homepage serves as a Dashboard and will is designed to give you some key figures and
                data that is related to your account,
                <br><br>
                Please feel free to look around and get a feel for the settings.
            </div>
    </div>

{{--Add the count results here --}}


{{--        Show latesat uplpload and 3 latest articles--}}


    </div>
@endsection