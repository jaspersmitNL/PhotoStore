@extends('layouts.admin')
@section('title', 'Admin dashboard')

<style>

    .inner {
        padding: 10px;
    }

    .icon {
        padding-right: 10px;
        float: right;
        margin-top: 4px;
    }

    .box {
        background-color: #17a2b8;
        color: #fff;
    }

</style>

@section('admin-content')

    <div class="container-fluid pb-5">
        <h1>Dashboard</h1>
        {{--Top Cards--}}
        <div class="row px-md-2 mb-2 mt-3">
            <div class="col col-md-3 border rounded-3 box">
                <div class="inner">
                    <h3>{{\App\Models\Order::whereDate('created_at', today())->where('isPaid','=', 1)->count()}} <i class="bi bi-bag icon"></i>
                    </h3>
                    <p>Bestellingen vandaag</p>
                </div>
            </div>

            <div class="col col-md-3 border rounded-3 box">
                <div class="inner">
                    <h3>{{\App\Models\Order::whereMonth('created_at', now()->month)->where('isPaid', '=',1)->count()}} <i
                            class="bi bi-bag icon"></i></h3>
                    <p>Bestellingen deze maand</p>
                </div>
            </div>

            <div class="col col-md-3 border rounded-3 box">
                <div class="inner">
                    <h3>
                        € {{sprintf("%.2f", \App\Models\Order::whereDate('created_at', today())->where('isPaid', '=', 1)->sum('price'))}}
                        <i class="bi bi-cash icon"></i></h3>
                    <p>Omzet vandaag</p>
                </div>
            </div>

            <div class="col col-md-3 border  rounded-3 box">
                <div class="inner">
                    <h3>
                        € {{sprintf("%.2f", \App\Models\Order::whereMonth('created_at', now()->month)->where('isPaid', '=', 1)->sum('price'))}}
                        <i class="bi bi-cash icon"></i></h3>
                    <p>Omzet deze maand</p>
                </div>
            </div>
        </div>

    </div>

@endsection
