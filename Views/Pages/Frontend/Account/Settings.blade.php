@extends("Layouts.main")


@section("content")
    <div class="row">
        <div class="col-sm-12 col-md-4">

            @include("Includes.AccountNav")
        </div>
        {{--        Side panel--}}
        <div class=".col-sm-12 col-md-8">
            <div class="form-row pt-1 head">
                User Settings page
            </div>
            <form action="{{$url->make("account.settings.store")}}" method="post">
                <div class="form-row">
                    <div class="form-group col-md-6 text-right">
                        <label for="twofactorauth">Use Two Factor Authentication :</label>
                    </div>

                    <div class="form-group col-md-6 text-center">
                        <input type="checkbox" checked name="towfactorauth"">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6 text-right">
                        <label for="newsletters">Recieve news letters :</label>
                    </div>
                    <div class="form-group col-md-6 text-center">
                        <input type="checkbox" checked name="newsletters">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6 text-right">
                        <label for="display_full_name">
                            Allow otheres to see your full name :
                        </label>
                    </div>
                    <div class="form-group col-md-6 text-center">
                        <input type="checkbox" checked name="display_full_name">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6 text-right">
                        <label for="display_full_name">
                            Allows others to see your date of birth :
                        </label>
                    </div>
                    <div class="form-group col-md-6 text-center">
                        <input type="checkbox" checked name="display_full_name">
                    </div>
                </div>
                <div class="form-row">

                    <div class="form-group text-right col-sm-12">
                        <button class="btn btn-primary">Save</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection

