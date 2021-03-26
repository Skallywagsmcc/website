@extends("Layouts.main")


@section("content")

    <form action="/account/edit/settings" method="post" enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group">
                <div class="col-md-6">Two Factor authentication :</div>
                <div class="col-md- form-control"><select name="twofactorauth" id="">
                        <option value="0">Turn off Two factor authentcation</option>
                        <option value="1">Turn on Two factor authentcation</option>
                    </select>
                </div>
                <div class="form-group">
                    <div class="col-md-6">username Settings :</div>
                    <div class="col-md- form-control"><select name="fullname" id="">
                            <option value="0">hide full name</option>
                            <option value="1">Show Full name</option>
                        </select>
                    </div>
                </div>

            </div>
        </div>
        <button>Save</button>
    </form>

@endsection