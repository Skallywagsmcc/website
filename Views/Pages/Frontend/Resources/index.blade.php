@extends("Layouts.main")

@section("content")


    <div class="container">

        <div class="row">
            @if($value->resources->count() == 0)
            <div class="col-sm-12 head">Oh Dear!</div>
                <div class="col-sm-12 text-center py-2">We are sorry it seems that No Useful Links have been added at this moment Please come back another time.</div>
            <div class="col-sm-12 py-2 text-center">Think this is a result of an error Please feel free to send us a message by : <a href="{{$url->make("contact-us")}}">Clicking here</a></div>
            @else
                @foreach ($value->resources as $category)
                    @if($category->count() > 0)
                        @if($category->Resources()->count() > 0)
                            <div class="col-sm-12 col-lg-4">
                                <div class="col-sm-12 head">
                                    {{ucfirst($category->name)}}
                                </div>
                                @foreach($category->Resources()->take(3) as $resource)
                                    @if($value->ValidateVar($resource->value,FILTER_VALIDATE_URL) == true)
                                        <div class="col-sm-12 py-2 text-center">
                                            Link : <a href="{{$resource->value}}" target='_new'>{{$resource->name}}</a>
                                        </div>
                                    @elseif($value->ValidateVar($resource->value,FILTER_VALIDATE_EMAIL) == true)
                                        <div class="col-sm-12 py-2 text-center">
                                            Email : <a href="mailto:{{$resource->value}}"
                                                       target='_new'>{{$resource->name}}</a>
                                        </div>
                                    @else
                                        <div class="col-sm-12 py-2 text-center">
                                            {{ucfirst($resource->name)}}
                                        </div>
                                    @endif
                                @endforeach
                                @if($category->Resources()->count() >= 3)
                                    <div class="col-sm-12">
                                        <a href="{{$url->make("resources.view",["slug"=>$category->slug])}}"
                                           class="text-center text-lg-right pr-lg-2 py-2 d-block">View More</a>
                                    </div>
                                @endif
                            </div>
                        @endif
                    @endif
                @endforeach
            @endif
        </div>
    </div>


    {{--    foreach ($category->Resources() as $resource)--}}
    {{--    {--}}
    {{--    if($this->ValidateVar($resource->value,FILTER_VALIDATE_URL) == true)--}}
    {{--    {--}}
    {{--    echo "<a href='".$resource->value."' target='_new'>$resource->name</a>";--}}
    {{--    }--}}
    {{--    if($this->ValidateVar($resource->value,FILTER_VALIDATE_EMAIL) == true)--}}
    {{--    {--}}
    {{--    echo " Email : <a href='mailto:".$resource->value."'>$resource->name</a>";--}}
    {{--    }--}}
    {{--    else--}}
    {{--    {--}}
    {{--    echo $resource->name;--}}
    {{--    }--}}
    {{--    echo "<br>";--}}
    {{--    }--}}
    {{--    echo "<hr>";--}}
    {{--    }--}}
@endsection