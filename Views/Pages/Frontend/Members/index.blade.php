@extends("Layouts.main")

@section("title")
    Members Home
@endsection

@section("content")

    <div class="container">
        <div class="row">
            @if($members->count() == 0)
                <div class="col-sm-12 head">No Members found</div>
                <div class="col-sm-12">It seems that No Members have been added to the system currently</div>
            @else
                <div class="col-sm-12 head">Our Members</div>
                @foreach($members as $member)
                    <div class="col-sm-12.col-md-3 my-1">
                        <div class="col-sm-12 my-1">
                            <div class="col-sm-12">
                                <img src="/img/uploads/{{$member->user->Profile->image->image_name}}" height="200"
                                     width="200" alt="">
                            </div>
                            <div class="col-sm- text-center my-2 border border-top-1  border-primary">
                                {{$member->user->Profile->user->username}}
                            </div>
                        </div>
                    </div>
                @endforeach

            @endif
        </div>
    </div>

@endsection