@extends("Layouts.main")


@section("content")

    @if($user->profile_count == 1)
        we found your profile <a href="/profile/editor/manage">Edit your profile</a>
    @else
        <form action="/profile/editor/create" method="post">
            <button>Create your profile</button>
        </form>
    @endif
{{--    the profile information will show down here.--}}
    @endsection