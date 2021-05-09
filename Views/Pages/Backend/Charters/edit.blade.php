@extends("Layouts.main")

@section("title")
    Charters
@endsection


@section("content")

    <div class="container">
        <div class="row head">List a new Charter</div>
        <form action="{{$url->make("admin.charters.update")}}" method="post">
            {{csrf()}}
            <input type="text" name='id' value="{{$charter->id}}">
            <div class="form-group">
                <label for="title">Charter Name</label>
                <input type="text" name="title" class="form-control" value="{{$charter->title}}">
            </div>
            <div class="form-group">
                <label for="content">Information about the charter</label>
                <textarea name="content" id="" cols="30" rows="10" class="form-control">{{$charter->content}}</textarea>
            </div>

            <div class="form group"><label for="pinned">Make This Charter Default</label>
                <input type="checkbox" @if($charter->pinned == 1) checked @endif name="pinned" value="1"/>
            </div>

            <div class="form-group">
                <button class="btn btn-primary btn-block">Save</button>
            </div>
        </form>
    </div>

@endsection