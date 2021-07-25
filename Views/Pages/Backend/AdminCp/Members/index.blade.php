@extends("Layouts.backend")

@section("title")
    Admin Panel : Members Home
@endsection

@section("content")

    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-9 text-center">

                    We have found {{$members->count()}} Registered Crew
                    @if(($members->count() > 1) || $members->count() == 0)
                        Members
                    @else
                        Member
                    @endif


            </div>
            <div class="col-sm-12 col-md-3 text-center text-md-right">
                <a href="#">Create New Member</a>
            </div>
        </div>
    </div>
{{--    list all members --}}
    <div class="container">
        <div class="row">
            @foreach($members as $member)
            <div class="col-sm-12 col-md-4">

                <img src="/img/uploads/{{$member->user->Profile->image->name}}" alt="{{$member->user->username}}">
            </div>
            @endforeach
        </div>

    </div>

@endsection