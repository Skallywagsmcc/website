<!DOCTYPE html>
<html>
<head>
    <title>Skallywags MCC @yield("title") </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/Assets/css/bootstrap.css">
    <link rel="stylesheet" href="/Assets/custom/css/backend/backend.css"/>
    <script src="/Resources/js/jquery.js"></script>
    <script src="/Resources/js/popper.js"></script>
    <script src="/Resources/js/bootstrap.min.js"></script>
    <script src="/Assets/js/functions.js" type="text/javascript"></script>
</head
<body>
<div class="container-fluid m-0 p-0">
    <div class="row p-0 m-0">
        <div class="col-sm-12 col-md-2 p-0 m-0 ">
            <div id="container-wrapper">
                <div class="col-sm-12 img-fluid justify-content-center">
                    <img src="/img/logo.png" class="img-fluid my-2 p-2" alt="Logo">
                </div>

                <div id="navbar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Active</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                        </li>
                    </ul>
                </div>
                <div class="footer">
                    Skallywags MCC
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-10">
{{--            @yield("content")--}}
        </div>
    </div>
</div>
</body>
</html>