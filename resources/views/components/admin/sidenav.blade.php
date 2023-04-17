<?php
function checkName($name) {
    return Route::currentRouteName() == $name ? 'nav-link-active' : '';
}

?>

<!--suppress CssUnusedSymbol -->
<style>
    .sidebar {
        /*width: 240px;*/
        width: 35%;

        position: fixed;
        min-height: 100%;
        background-color: #F6F8FB;
        top: 54px;
        left: 0;
    }

    @media only screen and (min-width: 650px) {
        .sidebar {
            width: 240px;
        }
    }

    .nav-link {
        color: black !important;
        transition: 0.3s all;
        width: 85%;
        border-radius: 15px;
    }

    .nav-link:hover {
        transform: translateX(10px);
        background-color: gray;

    }

    .nav-link-active {
        transform: translateX(10px);
        font-weight: bold;
    }

    body {
        overflow: auto !important;
    }

</style>

<div class="sidebar">
    <nav class="navbar-dark">
        <ul class="navbar-nav my-2">
            {{-- Dashboard link --}}
            <div>
                <li>
                    <div class="text-muted small fw-bold text-uppercase px-3 mb-1">
                        Dashboard
                    </div>
                </li>

                <li>
                    <a href="{{route('admin.dashboard')}}"
                       class="nav-link px-3 active {{checkName('admin.dashboard')}}">
                        <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="my-2">
                    <hr class="dropdown-divider bg-dark"/>
                </li>
            </div>

            {{-- Bookings category --}}
            <div>
                <li>
                    <div class="text-muted small fw-bold text-uppercase px-3 mb-1">
                        Boekingen
                    </div>
                </li>

                <li>
                    <a href="{{route('admin.booking.index')}}"
                       class="nav-link px-3 active {{checkName('admin.booking.index')}}">
                        <span class="me-2"><i class="bi bi-images"></i></span>
                        <span>Boekingen</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('admin.booking.create')}}"
                       class="nav-link px-3 active {{checkName('admin.booking.create')}}">
                        <span class="me-2"><i class="bi bi-images"></i></span>
                        <span>Boeking aanmaken</span>
                    </a>
                </li>

                <li class="my-2">
                    <hr class="dropdown-divider bg-dark"/>
                </li>
            </div>

            {{-- Orders category --}}
            <div>
                <li>
                    <div class="text-muted small fw-bold text-uppercase px-3 mb-1">
                        Bestellingen
                    </div>
                </li>

                <li>
                    <a href="{{route('admin.order.index')}}"
                       class="nav-link px-3 active {{checkName('admin.order.index')}}">
                        <span class="me-2"><i class="bi bi-basket"></i></span>
                        <span>Bestellingen</span>
                    </a>
                </li>


                <li class="my-2">
                    <hr class="dropdown-divider bg-dark"/>
                </li>
            </div>
        </ul>
    </nav>

</div>
