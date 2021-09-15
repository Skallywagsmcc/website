@extends("Layouts.backend")

@section("title")
    Charters
@endsection


@section("content")

    <div class="container">
        <div class="row head">List a new Charter</div>
        <form action="{{$url->make("auth.admin.charters.update")}}" method="post" enctype="multipart/form-data">
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

            <div class="form-group">
                <label for="url">Charter Url</label>
                <input type="url" name="url" value="{{$charter->url}}" placeholder="url to charter group">
            </div>

            Thumbnail Image :  <input type="file" name="thumb">
            Cover Image : <input type="file" name="cover">


            <div class="form-group">
                <button class="btn btn-primary btn-block">Save</button>
            </div>
        </form>
    </div>

@endsection