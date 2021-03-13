@extends("Layouts.main")


@section("content")

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="/profile/manage/basic">Basic Information</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="/profile/manage/picture">Change Profile Picture</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="/profile/manage/about">About me</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="/profile/manage/med-records">Medical Record information</a>
        </li>
    </ul>

    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Home</a>
        <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</a>
        <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</a>
        <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a>
    </div>

    <form action="profile/editor/manage" method="post">
       Full Name <input type="text" readonly name="id" value="{{$user->id}}"><br>
        <input type="text" name="full_name" value="{{$user->Profile->first_name}}"> |
        <input type="text" name="full_name" value="{{$user->Profile->Middle_names}}"> |
        <input type="text" name="full_name" value="{{$user->Profile->last_name}}"> <br>
        {{$user->Profile->dob}}
        <hr>
        <textarea name="about">{{$user->Profile->about}}</textarea><br>
{{--        We need to verify the image is empty and if so leave it --}}

    </form>
@endsection