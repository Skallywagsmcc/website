<div class="row box my-2 p-2">
    <div class="col-sm-12"><label for="title text-left py-2">Label For your Address</label></div>
    <div class="col-sm-12"><input type="text" class="form-control" name="title"
                                  value="@isset($request){{$request->title}}@endisset"
                                  placeholder="Reference of address"></div>
</div>

<div class="row box my-2 p-2">
    <div class="col-sm-12"><label for="title text-left py-2">Street Number or Building Name </label></div>
    <div class="col-sm-12">
        <input type="text" name="name" class="form-control"
               value="@isset($request){{$request->name}}@endisset"
               placeholder="Building name or number">
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12 col-lg-6 box my-2 py-2">
                <div class="col-sm-12"><label for="title text-left py-2">Street Name</label></div>
                <div class="col-sm-12">
                    <input type="text" name="street" class="form-control"
                           value="@isset($request){{$request->street}}@endisset"
                           placeholder="Street name">
                </div>

            </div>
            <div class="col-sm-12 col-lg-6 box my-2 py-2">
                <div class="col-sm-12"><label for="title text-left py-2">Second Street name
                        (Optional)</label>
                </div>
                <div class="col-sm-12">
                    <input type="text" name="street_2" class="form-control"
                           value="@isset($request){{$request->street_2}}@endisset"
                           placeholder="Street name line 2 optional">
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12 col-lg-4 box my-2 py-2">
                <div class="col-sm-12"><label for="title text-left py-2">City</label></div>
                <div class="col-sm-12">
                    <input type="text" name="city" class="form-control"
                           value="@isset($request){{$request->city}}@endisset"
                           placeholder="City">
                </div>
            </div>
            <div class="col-sm-12 col-lg-4 box my-2 py-2">
                <div class="col-sm-12"><label for="title text-left py-2">County</label></div>
                <div class="col-sm-12">
                    <input type="text" name="county" class="form-control"
                           value="@isset($request){{$request->county}}@endisset"
                           placeholder="county">
                </div>
            </div>

            <div class="col-sm-12 col-lg-4 box my-2 py-2">
                <div class="col-sm-12"><label for="title text-left py-2">Postcode</label></div>
                <div class="col-sm-12">
                    <input type="text" name="postcode" class="form-control"
                           value="@isset($request){{$request->postcode}}@endisset"
                           placeholder="Postcode">
                </div>
            </div>

        </div>
    </div>
</div>
{{--            Setup is for adding to contact page--}}
