@extends('layouts.app')

@section('head')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.3.1/dist/chart.min.js"
            integrity="sha256-BSa1suEDn1YuT46b7ZQLKfmV3Bk3CViZ4dyj5FMoZHA=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('admin-head')
@endsection

<style>
    .spacing {
        margin-left: 35%;
    }

    @media only screen and (min-width: 650px) {
        .spacing {
            margin-left: 240px;
        }
    }
    .content {
        background-color: #F4F6F9;
        height: calc(100% - 64px);
        margin-top: -10px;
    }
</style>

@section('content')

    @include('components.admin.sidenav')

    <div class="spacing content" style="overflow-x: hidden;">
        <div class="container-fluid">
            @yield('admin-content')
        </div>
    </div>


@endsection
