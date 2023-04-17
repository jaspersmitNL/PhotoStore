@extends('layouts.admin')
@section('title', 'Admin dashboard - Bestellingen ')

@section('admin-content')
    <div class="container mt-5">
        <div class="col col-md-12">
            @livewire('admin.order-table')
        </div>
    </div>

@endsection

