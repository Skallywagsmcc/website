@extends("Layouts.main")

@section("title")
    Members
    @endsection

@section("content")
    {{\App\Http\Libraries\Authentication\Auth::id()}}
    {{$members->count()}}
 @foreach($members as $member)
{{$member->user->Profile->user->username}}
    @endforeach
@endsection