@extends("Layouts.main")

@section("content")
    <div class="container">


        @isset($message)
            <div class="alert-danger my-1 py-1">
                {!! $message !!}
            </div>
        @endisset

        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="col-sm-12">
                    <div class="col-sm-12 head">Reset Your Password</div>
                    <form action="{{$url->make("password-reset.request")}}" method="post" class="tld-form">
                        <label for="email">Email Address</label>
                        <input type="text" name="email" class="form-control tld-input">
                        <button class="btn tld-button btn-block my-2">Reset Password</button>
                    </form>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="col-sm-12 head">Reactivate Login</div>
                <div class="col-sm-12">
                    <form action="{{$url->make("password.cancel.index")}}" method="post" class="tld-form">
                        <label for="email">Email Address</label>
                        <input type="text" name="email" class="form-control tld-input">
                        <button class="btn tld-button btn-block my-2">Reactivate</button>
                    </form>
                </div>
            </div>
        </div>


        <div class="row my-1">
            <div class="col-sm-12 head">
                About Resetting your password
            </div>
            <div class="col-sm-12">
                <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita, iusto maxime minima non
                    praesentium provident reprehenderit repudiandae voluptatem. Amet aspernatur illum incidunt iure
                    magnam nesciunt odit optio quibusdam quisquam velit.
                </div>
                <div>Aliquid amet atque distinctio, dolorem ducimus, earum eius eligendi excepturi iure, non pariatur
                    perspiciatis ratione rerum sapiente sed. Ad distinctio eaque incidunt libero minus molestiae
                    nesciunt, quo repellat reprehenderit tenetur.
                </div>
                <div>Culpa harum, magnam. Aperiam cum, eum iure maxime necessitatibus quis ratione reiciendis
                    repudiandae ullam. Alias aliquam architecto consequatur, cum, delectus dolores fugiat inventore
                    nobis quae quaerat quibusdam ratione vero voluptatum!
                </div>
                <div>Alias architecto asperiores autem dicta dolores ea expedita ipsam iure laudantium magni maxime nam
                    nihil, odio officiis pariatur perferendis praesentium quam qui quibusdam quod quos reprehenderit sit
                    soluta, ullam voluptas?
                </div>
                <div>Commodi consequuntur cupiditate eaque explicabo ipsa labore magni minus mollitia, nemo nulla optio,
                    pariatur porro provident quis repudiandae tempore veniam. Assumenda aut consequatur excepturi
                    exercitationem explicabo neque quisquam repellendus suscipit?
                </div>
                <div>Adipisci blanditiis, ipsa minima necessitatibus nobis odio recusandae repellendus suscipit.
                    Distinctio dolor nemo praesentium reprehenderit tempora! Dignissimos doloribus eligendi enim facilis
                    impedit iure maiores natus quis reiciendis, sequi vero voluptate?
                </div>
                <div>Accusantium corporis facere ipsa omnis repellendus! A autem beatae consectetur delectus dolor
                    facilis in ipsum laboriosam, minus numquam odio officia, perferendis praesentium recusandae sequi,
                    tempora velit voluptates. Ad, excepturi odit.
                </div>
                <div>Aut corporis, delectus facilis possimus quo rem sapiente unde. Consequatur delectus earum facilis
                    neque nulla quasi saepe ut? Aut dolor dolores eligendi ipsa itaque, mollitia nesciunt nobis quaerat
                    tenetur voluptate.
                </div>
            </div>
        </div>
    </div>
@endsection