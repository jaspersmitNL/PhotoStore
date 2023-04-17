<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Models\Booking;

class BookingController extends Controller {

    function index($id) {
        $booking = Booking::findOrFail($id);


        $landscapePhotos = $booking->photos->filter(function ($el) {
            return $el->mode == "landscape";
        })->all();

        $portraitPhotos = $booking->photos->filter(function ($el) {
            return $el->mode == "portrait";
        })->all();

        $squarePhotos = $booking->photos->filter(function ($el) {
            return $el->mode == "square";
        })->all();

        return view('user.booking.index', [
            'booking' => $booking,
            'photos' => [
                'landscape' => $landscapePhotos,
                'portrait' => $portraitPhotos,
                'square' => $squarePhotos
            ]
        ]);
    }


}
