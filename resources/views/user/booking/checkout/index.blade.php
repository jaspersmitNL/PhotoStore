@extends('layouts.app')
@section('title', 'Boeking '.$booking->title)
@include('functions')


@section('content')


    <div class="container">
        <a class="btn btn-primary" href="{{route('booking.index', ['id' => $booking->id])}}">Terug</a>


        <div class="py-5 row g-5">
            <div class="col-md-7 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary">Mijn winkelwagen.</span>
                    <span class="badge bg-primary rounded-pill">{{count($basket)}}</span>
                </h4>
                <ul class="list-group mb-3">


                    @foreach($photos as $photo)
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <img width="100" height="100" src="{{$photo->toWatermarkedSRC()}}" alt="">
                                <h6 class="my-0">{{$photo->originalFileName}}
                            </div>

                            <form
                                action="{{route('basket.'. (isInBasket($booking->id, $photo->id) ? 'remove' : 'add')) }}"
                                method="post">
                                @csrf
                                <input type="text" name="booking"
                                       value="{{$booking->id}}" hidden>
                                <input type="text" name="photo"
                                       value="{{$photo->id}}" hidden>
                                <button type="submit" class="btn btn-outline-dark mt-5">
                                    <i class="bi bi-trash">Verwijder</i>
                                </button>
                            </form>

                            <span class="text-muted">€{{number_format($booking->price_per_photo, 2)}}</span>


                        </li>
                    @endforeach


                    @if($booking->numof_free_photos > 0)
                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <div class="text-success">
                                <h6 class="my-0">Gratis fotos ({{number_format($used_free_photos, 2)}})</h6>
                            </div>
                            <span class="text-success">−€{{number_format($discount, 2)}}</span>
                        </li>
                    @endif

                    <li class="list-group-item d-flex justify-content-between">
                        <span>Totaal (EUR)</span>
                        <strong>€{{number_format($total_price, 2)}}</strong>
                    </li>

                </ul>

{{--                TODO: Move to a LiveWire view--}}
{{--                <form class="card p-2">--}}
{{--                    <div class="input-group">--}}
{{--                        <input type="text" class="form-control" placeholder="Kortingscode">--}}
{{--                        <button type="submit" class="btn btn-secondary">Invoeren</button>--}}
{{--                    </div>--}}
{{--                </form>--}}
            </div>


            <div class="col-md-5">

                <form method="post" action="{{route('booking.checkout.confirm', ['id' => $booking->id])}}">
                    @csrf

                    <div class="row">

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="first_name" class="form-label">Voornaam</label>
                                <input type="text" class="form-control" id="first_name" name="first_name"
                                       value="{{old('first_name')}}">
                                <span class="text-danger">@error('first_name'){{$message}}@enderror</span>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="last_name" class="form-label">Achternaam</label>
                                <input type="text" class="form-control" id="last_name" name="last_name"
                                       value="{{old('last_name')}}">
                                <span class="text-danger">@error('last_name'){{$message}}@enderror</span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                       value="{{old('email')}}">
                                <span class="text-danger">@error('email'){{$message}}@enderror</span>
                            </div>
                        </div>

                    </div>


                    <button type="submit" class="btn btn-primary" @if(count($basket) < 1) disabled @endif>Betalen
                    </button>
                </form>

            </div>
        </div>


    </div>
@endsection



@section('scripts')
    <script>
        var notyf = new Notyf({
            position: {x: 'right', y: 'top'},
            dismissible: true
        });
        //
        // var perfEntries = performance.getEntriesByType("navigation");
        //
        // if (perfEntries[0].type === "back_forward") {
        //     location.reload();
        // }
    </script>
@endsection
