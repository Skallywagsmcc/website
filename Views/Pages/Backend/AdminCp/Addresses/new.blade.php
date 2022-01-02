@extends("Layouts.Themes.BaseGrey.Admin")
@section("title")
    {{APP_NAME}} Admin panel Addresses
@endsection

@section("content")


    @isset($error)
        <div class="container my-2">
            <div class="row box">
                <div class="col-sm-12 head py-2 text-center text-lg-left pl-lg-2">An Error Occurred</div>
                <div class="col-sm-12 text-center">{{$error}}</div>
                <div class="col-sm-12.pl-lg-2 text-center text-lg-left">
                    @isset($required)
                        @foreach($required as $required)
                            <strong class="p-2 tu my-2">{{$required}}</strong>
                        @endforeach
                    @endisset
                </div>

            </div>
        </div>
    @endisset
    <div class="container">

        <div class="row box my-2">
            <div class="col-sm-12 text-center text-lg-left head pl-lg-2">Add new address</div>
        </div>
        <form action="{{$url->make("auth.admin.addresses.store")}}" method="post">
            {{csrf()}}

            <div class="row box my-2 p-2">
                <div class="col-sm-12"><label for="title text-left py-2">Label For your Address</label></div>
                <div class="col-sm-12"><input type="text" class="form-control" name="title"
                                              value="@isset($post){{$post->title}}@endisset"
                                              placeholder="Reference of address"></div>
            </div>

            <div class="row box my-2 p-2">
                <div class="col-sm-12"><label for="title text-left py-2">Street Number or Building Name </label></div>
                <div class="col-sm-12">
                    <input type="text" name="name" class="form-control"
                           value="@isset($post){{$post->name}}@endisset"
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
                                       value="@isset($post){{$post->street}}@endisset"
                                       placeholder="Street name">
                            </div>

                        </div>
                        <div class="col-sm-12 col-lg-6 box my-2 py-2">
                            <div class="col-sm-12"><label for="title text-left py-2">Second Street name
                                    (Optional)</label>
                            </div>
                            <div class="col-sm-12">
                                <input type="text" name="street_2" class="form-control"
                                       value="@isset($post){{$post->street_2}}@endisset"
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
                                       value="@isset($post){{$post->city}}@endisset"
                                       placeholder="City">
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-4 box my-2 py-2">
                            <div class="col-sm-12"><label for="title text-left py-2">County</label></div>
                            <div class="col-sm-12">
                                <input type="text" name="county" class="form-control"
                                       value="@isset($post){{$post->county}}@endisset"
                                       placeholder="county">
                            </div>
                        </div>

                        <div class="col-sm-12 col-lg-4 box my-2 py-2">
                            <div class="col-sm-12"><label for="title text-left py-2">Postcode</label></div>
                            <div class="col-sm-12">
                                <input type="text" name="postcode" class="form-control"
                                       value="@isset($post){{$post->postcode}}@endisset"
                                       placeholder="Postcode">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            {{--            Setup is for adding to contact page--}}

            <div class="row box my-2 p-2">
                <div class="col-sm-12 col-lg-10 text-center text-lg-right pr-lg-2"><label for="title text-left py-2">Place on contact us page</label></div>
                <div class="col-sm-12 col-lg-2 text-center">
                    <input type="checkbox" name="contactus" @if($action->request == "contact") checked @else @isset($post) @if($post->contactus==1) checked @endif @endisset @endif value="1">
                </div>
            </div>

            <div class="row  my-2 p-2">
                <div class="col-sm-12">
                    <button class="btn btn-block btn-primary">Save Address</button>
                </div>
            </div>



        </form>
    </div>
@endsection