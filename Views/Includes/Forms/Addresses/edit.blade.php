<div class="row box my-2 p-2">
    <div class="col-sm-12"><label for="title text-left py-2">Label For your Address</label></div>
    <div class="col-sm-12"><input type="text" class="form-control" name="title"
                                  value="@isset($request->title){{$request->title}}@else{{$request->address->title}}@endisset"
                                  placeholder="Reference of address"></div>
</div>

<div class="row box my-2 p-2">
    <div class="col-sm-12"><label for="title text-left py-2">Street Number or Building Name </label></div>
    <div class="col-sm-12">
        <input type="text" name="name" class="form-control"
               value="@isset($request->name){{$request->name}}@else{{$request->address->name}}@endisset"
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
                           value="@isset($request->street){{$request->street}}@else{{$request->address->street}}@endisset"
                           placeholder="Street name">
                </div>

            </div>
            <div class="col-sm-12 col-lg-6 box my-2 py-2">
                <div class="col-sm-12"><label for="title text-left py-2">Second Street name
                        (Optional)</label>
                </div>
                <div class="col-sm-12">
                    <input type="text" name="street_2" class="form-control"
                           value="@isset($request->street_2){{$request->street_2}}@else{{$request->address->street_2}}@endisset"
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
                           value="@isset($request->city){{$request->city}}@else{{$request->address->city}}@endisset"
                           placeholder="City">
                </div>
            </div>
            <div class="col-sm-12 col-lg-4 box my-2 py-2">
                <div class="col-sm-12"><label for="title text-left py-2">County</label></div>
                <div class="col-sm-12">
                    <input type="text" name="county" class="form-control"
                           value="@isset($request->county){{$request->county}}@else{{$request->address->county}}@endisset"
                           placeholder="county">
                </div>
            </div>

            <div class="col-sm-12 col-lg-4 box my-2 py-2">
                <div class="col-sm-12"><label for="title text-left py-2">Postcode</label></div>
                <div class="col-sm-12">
                    <input type="text" name="postcode" class="form-control"
                           value="@isset($request->postcode){{$request->postcode}}@else{{$request->address->postcode}}@endisset"
                           placeholder="Postcode">
                </div>
            </div>

        </div>
    </div>
</div>
