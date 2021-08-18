@extends("Layouts.main")

@section("title")
    Our Events
@endsection

@section("content")
<div class="container my-2">
    <div class="row  bg-dark">
        <div class="col-sm-12 py-2 col-md-9 text-center">The Next Event : {{$first->title}}</div>
        <div class="col-sm-12 col-md-3 py-2 text-center d-block d-md-none"><a class="d-block" href="{{ $url->make("events.view",["slug"=>$first->slug]) }}">View event</a>
    </div>
</div>
</div>

<div class="container my-2 d-none d-md-block">
    <div class="row">
        <div class=" col-sm-12 px-0 head">About event : {{ $first->title }}</div>
        <div class="col-sm-12 p-2">{{ $first->content }}</div>
    </div>
</div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-4 px-0">
                <div class="col-sm-12 head ">Events by Year</div>
                @foreach($years as $year)
                    <div class="text-center">
                        <a href="{{$url->make("events.view.year",["year"=>$year->year])}}">{{$year->year}}</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="container my-2">
        <div class="row">
            <div class="col-sm-12 head">More Events</div>
                @foreach($next as $n)
                    <div class="col-sm-12 col-md-3">
                        <div class="col-sm-12 py-0 d-flex justify-content-center">
                            <img src="/img/logo.png" class="img-fluid" alt="" height="150px" width="150px">
                        </div>
                        <div class="col-sm-12 p-0 my-2 text-center"><a href="{{$url->make("events.view",["slug"=>$n->slug])}}">{{$n->title}}</a></div>
                    </div>
                @endforeach
        </div>
    </div>

    <div class="container my-2">
        <div class="row">
            <div class="col-sm-12 head">Latest Events</div>
            <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa nemo quibusdam voluptates! Atque dolor
                doloremque ea, eum ex sit voluptatem! A delectus distinctio eveniet incidunt minima, porro repudiandae
                suscipit voluptatibus.
            </div>
            <div>Adipisci aspernatur beatae, dolorem, doloribus earum harum incidunt laboriosam nam nostrum omnis optio
                quasi quia rem, sint sit tenetur totam ut voluptates. Et, harum officia provident quo recusandae
                reprehenderit soluta.
            </div>
            <div>Alias cum deserunt eos error explicabo facere, impedit inventore iure laborum libero magni, maxime
                molestiae obcaecati quisquam quos, ratione rerum sint tempora tenetur ullam! Aspernatur assumenda
                consequatur exercitationem tenetur veritatis.
            </div>
            <div>Aliquid aperiam architecto corporis cumque cupiditate debitis dolore doloremque ea est harum inventore
                iste itaque labore nam, neque nobis, nostrum nulla perferendis porro quaerat reprehenderit suscipit unde
                voluptates? Id, iusto!
            </div>
            <div>Ab accusamus accusantium ad aliquam assumenda at consectetur, dicta dolore dolorem explicabo facere
                harum impedit in inventore labore modi mollitia nesciunt nobis nostrum provident quis saepe sint tempore
                velit veritatis.
            </div>
            <div class="col-sm-12 text-center text-md-right">
                <a href="#" class="tld-link">See More Event</a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">

                <div class="col-sm-12 head ">Events by Year</div>
                @foreach($years as $year)
                    <div class="text-center">
                        <a href="{{$url->make("events.view.year",["year"=>$year->year])}}">{{$year->year}}</a>
                    </div>
                @endforeach


            </div>
            <div class="col-sm-8">
                <div class="col-sm-12 head">Event Reviews</div>
                <div class="col-sm-12">Review one</div>
                <div class="col-sm-12">Review 2</div>
                <div class="col-sm-12">a big review</div>
            </div>
        </div>
    </div>


@endsection