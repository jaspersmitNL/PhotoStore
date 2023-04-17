@extends('layouts.admin')
@section('title', 'Admin - Boekings')


@section('admin-content')



    <div class="container mt-5">
        @include('components.alert')

            <div class="col col-md-12">
                @livewire('admin.booking-table')
            </div>
        </div>

@endsection
