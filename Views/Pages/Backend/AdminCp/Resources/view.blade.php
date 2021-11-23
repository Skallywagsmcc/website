@extends("Layouts.backend")

@section("title")
    Admin Panel Resource
@endsection


@section("content")


    <div class="container my-2">
        <form action="{{$url->make("auth.admin.resources.store",["resource_id"=>base64_encode($category->first()->id)])}}" method="post">
        <div class="row box">

                <div class="col-sm-12 col-lg-4 py-2">
                    <div class="col-sm-12 py-2">Resource Name</div>
                    <div class="col-sm-12"><input type="text" class="form-control" name="name"></div>
                </div>
                <div class="col-sm-12 col-lg-4 py-2">
                    <div class="col-sm-12 py-2">Resource Value</div>
                    <div class="col-sm-12"><input type="text" class="form-control" name="value"></div>
                </div>
                <div class="col-sm-12 col-lg-4 py-2">
                    <div class="col-sm-12 my-2 my-3">
                     <button>Save</button>
                    </div>
                </div>

        </div>
        </form>
    </div>


    <div class="container my-2">
        <div class="row box">
            <div class="col-sm-12 head py-2 text-center text-lg-left pl-lg-2">{{$category->first()->name}}</div>


        @foreach($category->first()->Resources() as $resource)

            <div class="col-sm-12 py-2 col-lg-6"></div>
            {{$resource->name}}
                <a href="{{$url->make("auth.admin.resources.delete",["id"=>base64_encode($resource->id)])}}">Delete</a>
                @endforeach
        </div>
    </div>

@endsection