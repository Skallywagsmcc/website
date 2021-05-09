@extends("Layouts.main")

@section("title")
    Charters
@endsection


@section("content")

    <div class="container">
        <div class="row head">List a new Charter</div>
        <form action="{{$url->make("admin.charters.store")}}" method="post">
            {{csrf()}}
            <div class="form-group">
                <label for="title">Charter Name</label>
                <input type="text" name="title" class="form-control">
            </div>
            <div class="form-group">
                <label for="content">Information about the charter</label>
                <textarea name="content" id="" cols="30" rows="10" class="form-control"></textarea>
            </div>

            <div class="form group"><label for="pinned">Make This Charter Default</label>
                <input type="checkbox" name="pinned" value="1"/>
            </div>

            <div class="form-group">
                <button class="btn btn-primary btn-block">Save</button>
            </div>
        </form>
    </div>

@endsection