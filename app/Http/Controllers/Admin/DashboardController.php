<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;

class DashboardController extends Controller {
    function index() {
        $user = User::findOrFail(session()->get('currentUser'));

        return view('admin.dashboard', [
            'user' => $user,
            'bookings' => Booking::all()
        ]);


    }

}
