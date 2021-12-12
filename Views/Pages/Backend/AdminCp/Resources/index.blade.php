@extends("Layouts.Themes.BaseGrey.Admin")

@section("title")
    Admin Panel Resource
@endsection


@section("content")

    <div class="container my-2">
        <div class="row box mx-0 my-2">
            <div class="col-sm-12 head py-2 text-left">Add a new Resource</div>
        </div>
        <form action="{{$url->make("auth.admin.resource.category.store")}}" method="post">
            {{csrf()}}

            <div class="col-sm-12 col-lg-9 my-2 my-lg-0">
                <div class="col-sm-12"><label for="type">Resource Name</label></div>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="name">
                </div>
            </div>
            <div class="col-sm-12 col-lg-3 my-2 my-lg-0">
                <div class="col-sm-12"><label for="type"></div>
                <div class="col-sm-12 pt-2">
                    <button class="btn btn-block btn-primary">Save</button>
                </div>
            </div>

        </form>
    </div>

    @isset($categories)
        <div class="container my-2">
            <div class="row box mt-2">
                <div class="col-sm-12 head py-2 text-left">Resource Categories</div>
            </div>
            @foreach($categories as $category)

                <div class="row box my-2">
                    <div class="col-sm-12 col-lg-3 py-2"> {{$category->name}}</div>
                    <div class="col-sm-12 col-lg-3 py-2">Resource({{$category->resources()->count()}})</div>
                    <div class="col-sm-12 col-lg-2 py-2"><a
                                href="{{$url->make("auth.admin.resources.view",["resource_id"=>base64_encode($category->id)])}}}">View
                            Category</a>
                    </div>
                    <div class="col-sm-12 col-lg-2 py-2"><a
                                href="{{$url->make("auth.admin.resource.category.edit",["id"=>base64_encode($category->id)])}}">Rename
                            Category</a>
                    </div>      <div class="col-sm-12 col-lg-2 py-2"><a
                                href="{{$url->make("auth.admin.resource.category.delete",["id"=>base64_encode($category->id)])}}">Delete
                            Category</a>
                    </div>

                </div>
            @endforeach
        </div>
    @endisset

@endsection