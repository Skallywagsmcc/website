@extends("Layouts.main")

@section("title")
    Manage Featured Request
    @endsection

@section("content")
    <img src="/img/uploads/{{$featured->Image->image_name}}" height="250" width="250" alt="">

    Image uploaded by : {{$featured->Image->user->profile->first_name}} | this image has {{$likes->likes($featured->Image->uuid)->count()}}
    <form action="{{$url->make("admin.images.featured.store")}}" method="post">

        <input type="hidden" value="{{$featured->id}}" name="id">
       {{csrf()}}
        @php
            switch ($featured->status) {
                case 1:
                    $status = "Pending";
                    break;
                    case 2:
                        $status = "Approved";
                        break;
                        case 3 :
                            $status = "Rejected";
                            break;
                default:
                    $status = "";
            }
        @endphp
       Status : {{$status}}
        <select name="status">
            <option class="bg-danger" value="{{$featured->status}}" selected>Current : {{$status}}</option>
            <option class="bg-primary" value="1">Pending</option>
            <option value="2">Approve</option>
            <option value="3">Rejected</option>
        </select>

        <button class="btn btn-primary">Update</button>
    </form>
    @endsection