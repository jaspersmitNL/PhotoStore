@extends('layouts.app')
@section('title', 'Boeking '.$booking->title)
@include('functions')


@section('content')


    <div class="container">
        <div class="alert alert-success" role="alert">
            De bestelling voor boeking {{$booking->title}} is nu in behandeling.
            <p>U ontvangt zeer binnenkort een email.</p>
        </div>

    </div>
@endsection



@section('scripts')
    <script>
    </script>
@endsection
