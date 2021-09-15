@extends("Layouts.backend")

@section("title")
    Admin panel Settings
@endsection

@section("content")
    <div class="container">
        <div class="row col-sm-12 head">Update Account Settings</div>
    </div>

    <div class="container my-2">
        <div class="row">
            <div class="col-sm-12">@isset($error){{$error}}@endisset</div>
        </div>
    </div>

    <div class="container my-2">
        <div class="row col-sm-12 py-2">
            <form action="{{$url->make("auth.admin.settings.store")}}" method="post">
                {{csrf()}}

                Email Address   : <input type="text" name="email" value="{{$settings->contact_email}}"><br>
                Maintainence Mode : <select name="maintainence_status" id="">

                    Current Selection : @if($settings->maintainence_status == 1)
                        <option value="1">Maintainence Mode off</option>
                    @else
                        <option value="0">Maintainence Mode on</option>
                        @endif
                    <option value="0">Turn on Maintainence Mode</option>
                    <option value="1">Turn off Maintainence Mode</option>
                </select>
                <label for="password"> Your Password (required)</label><br>
                <input type="password" name="password">

                <button class="btn btn-primary btn-block">Save</button>
            </form>
        </div>
    </div>

@endsection