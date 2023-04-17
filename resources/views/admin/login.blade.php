@extends('layouts.app')
@section('title', 'Admin login')

@section('head')
    <link rel="stylesheet" href="{{\Illuminate\Support\Facades\URL::asset('css/admin/login.css')}}">
@endsection

@section('content')


    <div class="container">

        @include('components.alert')

                <div class="mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">Admin login</h5>
                            <form action="{{route('admin.validate')}}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" value="{{config('app.debug') ? 'admin@photostore.dev' : ''}}" class="form-control"  name="email" id="email">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" value="{{config('app.debug') ? '123' : ''}}" class="form-control" name="password" id="password">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>




</div>

@endsection
