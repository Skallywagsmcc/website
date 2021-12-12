@extends("Layouts.Themes.BaseGrey.Admin")

@section("title")
    Admin Panel Resource
@endsection


@section("content")

    @isset($error)
        <div class="container my-2">
            <div class="row box">
                <div class="col-sm-12 head py-2">An error Occurred</div>

                @isset($required)
                    @foreach($required as $required)
                        {{$required}} <br>
                    @endforeach
                @endisset
            </div>
        </div>
        @endisset

    <div class="container my-2">
        <form action="{{$url->make("auth.admin.resources.update")}}" method="post">
        <div class="row box">

            <input type="text" name="id" value="@isset($post){{$post->id}}@else{{$resource->id}}@endisset">
            <div class="col-sm-12 head py-2">Edit Resource : {{$resource->name}}</div>
                <div class="col-sm-12 col-lg-4 py-2">
                    <div class="col-sm-12 py-2">Resource Name</div>
                    <div class="col-sm-12"><input type="text" class="form-control" name="name" value="@isset($post){{$post->name}}@else{{$resource->name}}@endisset"></div>
                </div>
                <div class="col-sm-12 col-lg-4 py-2">
                    <div class="col-sm-12 py-2">Resource Value</div>
                    <div class="col-sm-12"><input type="text" class="form-control" name="value"  value="@isset($post){{$post->value}}@else{{$resource->value}}@endisset"></div>
                </div>
                <div class="col-sm-12 col-lg-4 py-2">
                    <div class="col-sm-12 my-2 my-3">
                     <button>Save</button>
                    </div>
                </div>

        </div>
        </form>
    </div>


@endsection