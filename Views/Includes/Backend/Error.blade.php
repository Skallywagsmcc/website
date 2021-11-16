@isset($error)
    <div class="container my-2">
        <div class="row box">
            <div class="col-sm-12 px-0  head text-center text-lg-left pl-lg-2">An Error occurred</div>
            <div class="col-sm 12">{{$error}}</div>
            @isset($required)
                @foreach($required as $required)
                    <div class="col-sm-12 py-2">{{$required}}</div>
                @endforeach
            @endisset
        </div>
    </div>
@endisset