@extends("Layouts.Themes.BaseGrey.Account")

@section("content")



            @isset($request->error)
                <div class="container-fluid mb-1">
                    <div class="row box">
                        <div class="col-sm-12 head py-2">An Error Occurred</div>
                        <div class="col-sm-12">{{$request->error}}</div>
                    </div>
                </div>
                @endisset()

{{--            Add Upload Image Setup here--}}


                <div class="container-fluid">
                    <div class="row box">
                        <div class="col-sm-12 head">Upload A new Image</div>
                    </div>
                    <form action="{{$url->make("account.picture.store")}}" method="post"
                          enctype="multipart/form-data" class="py-2">
                    {{csrf()}}
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="file" class="form-control" name="upload">
                            </div>
                        </div>

                        <div class="row py-2">
                            <div class="col-sm-12 my-1 text-right">Set as profile Picture : <input type="checkbox" name="ppic" value="1"></div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12"><button class="btn-block btn-primary btn">Upload Image</button></div>
                        </div>
                    </form>
                </div>

            <div class="container-fluid">
                <div class="row box">
                    <div class="col-sm-12">
                        <div class="col-sm-12 head">My Gallery</div>
                        <div class="row">
                            @foreach($request->images as $image)
                                <div class="col-sm-12 col-lg-4">
                                    <div class="col-sm-12 m-1 d-flex justify-content-center h-75">
                                        <img src="/img/uploads/{{$image->name}}" alt="{{$image->name}}"  class="img-fluid w-100">
                                    </div>
                                    <div class="row mx-0 text-center">
                                        <div class="col-sm-12 col-lg-6"><a href="{{$url->make("account.picture.set",["id"=>base64_encode($image->id)])}}">Set As Profile image</a></div>
                                        <a href="{{$url->make("account.picture.delete",["id"=>base64_encode($image->id)])}}">Delete Image</a>
                                    </div>
                                </div>
                            @endforeach

                            {!! $request->links !!}
                        </div>

                    </div>
                </div>
            </div>


    {{--    the profile information will show down here.--}}

@endsection