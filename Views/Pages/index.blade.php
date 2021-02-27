@extends("Layouts.main")
@section("title")
    Home
    @endsection
@section("content")
    Welcome tot the site this is the homepage
@endsection

<?php

        if(isset($_COOKIE['id']))
            {
                echo "you are logged in";
            }
        else
            {
                echo "You Are not logged in";
            }