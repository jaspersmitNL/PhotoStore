@extends('layouts.admin')
@section('title', 'Admin - Boeking aanmaken')


@section('admin-content')


    <div class="container mt-5">

        <h1>Boeking aanmaken.</h1>


        <form action="{{route('admin.booking.store')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Naam</label>
                <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
                <span class="text-danger">@error('title'){{$message}}@enderror</span>
            </div>


            <div class="mb-3">
                <label for="date" class="form-label">Datum</label>
                <input type="date" class="form-control" id="date" name="date" value="{{old('date')}}">
                <span class="text-danger">@error('date'){{$message}}@enderror</span>

            </div>


            <div class="mb-3">
                <label for="price_per_photo" class="form-label">Prijs per foto</label>
                <input type="number" step="0.01" class="form-control" id="price_per_photo" name="price_per_photo" value="{{old('price_per_photo')}}">
                <span class="text-danger">@error('price_per_photo'){{$message}}@enderror</span>

            </div>

            <div class="mb-3">
                <label for="numof_free_photos" class="form-label">Aantal gratis fotos</label>
                <input type="number" class="form-control" id="numof_free_photos" name="numof_free_photos" value="{{old('numof_free_photos')}}">
                <span class="text-danger">@error('numof_free_photos'){{$message}}@enderror</span>

            </div>



            <button type="submit" class="btn btn-primary">Aanmaken</button>

        </form>
    </div>

@endsection
