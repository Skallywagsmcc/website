@extends("Layouts.main")

@section("title")
    Members
    @endsection

@section("content")
    {{\App\Http\Libraries\Authentication\Auth::id()}}
    {{$members->count()}}
 @foreach($members as $member)
     <img src="/img/uploads/{{$member->user->Profile->image->image_name}}"  height="200" width="200" alt="">
{{$member->user->Profile->user->username}}
    @endforeach
@endsection