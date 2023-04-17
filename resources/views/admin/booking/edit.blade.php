@extends('layouts.admin')
@section('title', "Admin - Boeking ". $booking->title. " Bewerken")




@section('admin-content')


    <div class="container mt-5">

        <h1>Boeking Bewerken.</h1>


        <form action="{{route('admin.booking.update', ['id'=>$booking->id])}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Naam</label>
                <input type="text" class="form-control" id="title" name="title"
                       value="{{old('title', $booking->title)}}">
                <span class="text-danger">@error('title'){{$message}}@enderror</span>
            </div>


            <div class="mb-3">
                <label for="date" class="form-label">Datum</label>
                <input type="date" class="form-control" id="date" name="date" value="{{old('date', $booking->date)}}">
                <span class="text-danger">@error('date'){{$message}}@enderror</span>

            </div>


            <div class="mb-3">
                <label for="price_per_photo" class="form-label">Prijs per foto</label>
                <input type="number" step="0.01" class="form-control" id="price_per_photo" name="price_per_photo"
                       value="{{old('price_per_photo', $booking->price_per_photo)}}">
                <span class="text-danger">@error('price_per_photo'){{$message}}@enderror</span>

            </div>

            <div class="mb-3">
                <label for="numof_free_photos" class="form-label">Aantal gratis fotos</label>
                <input type="number" class="form-control" id="numof_free_photos" name="numof_free_photos"
                       value="{{old('numof_free_photos', $booking->numof_free_photos)}}">
                <span class="text-danger">@error('numof_free_photos'){{$message}}@enderror</span>

            </div>

            <div>
                <button type="submit" class="btn btn-primary">Bewerken</button>
                <button type="button" class="btn btn-danger fw-bold right float-end"
                        onclick="deleteBooking('{{$booking->title}}', '{{$booking->id}}')">Verwijder
                </button>

            </div>


        </form>

        <br>

    </div>

@endsection

@section('scripts')
    <script>

        function deleteBooking(name, id) {

            Swal.fire({
                title: `${name} Verwijderen?`,
                text: 'Weet je het zeker?',
                type: 'danger',
                showCancelButton: true
            }).then((res) => {
                if (res.isConfirmed) {
                    window.location.replace("{{route('admin.booking.delete', ['id' => 'ID'])}}".replace('ID', id))
                }
            })
        }


    </script>
@endsection
