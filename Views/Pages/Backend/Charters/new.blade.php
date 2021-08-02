@extends("Layouts.backend")

@section("title")
    Charters
@endsection


@section("content")

    <div class="container">
        <div class="row box">
            <div class="col-sm-12 head">List a new Charter</div>
        </div>
    </div>
    <div class="container my-2">
        <div class="row box">
            <div class="col-sm-12">
                <form action="{{$url->make("auth.admin.charters.store")}}" method="post" class="tld-form">
                    {{csrf()}}
                    <div class="form-group">
                        <label for="title">Charter Name</label>
                        <input type="text" name="title" class="form-control tld-input">
                    </div>
                    <div class="form-group">
                        <label for="content">Information about the charter</label>
                        <textarea name="content" id="" cols="30" rows="10" class="form-control tld-input"></textarea>
                    </div>

                    <div class="form group"><label for="pinned">Make This Charter Default</label>
                        <input type="checkbox" name="pinned" value="1"/>
                    </div>

                    <div class="form-group">
                        <button class="btn tld-button btn-block">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection