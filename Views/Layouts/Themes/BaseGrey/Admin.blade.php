<!DOCTYPE html>
<html>
<head>
    <title>Skallywags MCC @yield("title")</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/Assets/css/bootstrap.css">
    <link rel="stylesheet" href="/Assets/themes/BBB/backend/base.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="/Resources/js/popper.js"></script>
    <script src="/Resources/js/bootstrap.min.js"></script>
    <script src="/Assets/js/functions.js" type="text/javascript"></script>
    <script src="/Assets/js/Backend/ckeditor.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>
<div class="container-fluid" id="topbar">
    <div class="row">
        <div class="ml-2 mr-auto py-1">
            <img src="/img/logo.png" class="my-2" width="50px" height="50px" alt=""> | Admin Panel
        </div>
        <div class=" ml-auto mr-2 d-block d-lg-none">
            <div class="col-sm-12 py-3">
                <a href="#" class=" menu px-3 py-2 mx-1">Menu</a>
                <a href="#" class="closemenu px-3 py-2 mx-1">Close Menu</a>
            </div>

        </div>
    </div>
</div>
<div class="wrap">
    <div id="container" class="container-fluid">
        <div class="row">
            <div class="col-sm-12 px-0 mx-0 col-md-4 col-lg-2 d-none d-lg-block" id="navbar">
                <div class="row">
                    <div class="col-sm-12"><a href="" class="d-block py-2 active">Link a</a></div>
                    <div class="col-sm-12"><a href="" class="d-block py-2">Link B</a></div>
                    <div class="col-sm-12"><a href="" class="d-block py-2">Link c</a></div>
                    <div class="col-sm-12"><a href="" class="d-block py-2">Link D</a></div>
                </div>
            </div>
            <div class="col-sm-12  col-md-8 col-lg-10" id="content">
                <div class="row box m-2">
                    <div class="col-sm-12 py-2 head">
                        Welcome to the website
                    </div>
                    <div class="col-sm-12 py-2">
                        Your new DashBoard is coming soon it will be full of nice things
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer py-2">
    The footer goes here
</div>

</body>
</html>


<script>
    $(document).ready(function () {
        $(".closemenu").hide();
        $(".menu").click(function () {
            $(".closemenu").show()
            $("#navbar").removeClass("d-none");
            $(this).hide();
            return false
        })

        $("body").on("click", ".closemenu", function () {
            $(".menu").show();
            $("#navbar").addClass("d-none");
            $(this).hide();
            return false;
        })
    })
</script>