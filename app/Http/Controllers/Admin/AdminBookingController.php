<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminBookingController extends Controller {

    /**
     * Lists all bookings
     */
    function index() {
        return view('admin.booking.index', [
            'bookings' => Booking::all()
        ]);
    }

    /**
     * Show the create page
     */
    function create() {
        return view('admin.booking.create');

    }

    /**
     * Create a booking
     */
    function store() {

        $request = request();

        $request->validate([
            'title' => 'required|unique:bookings',
            'date' => 'required|date',
            'price_per_photo' => 'required',
            'numof_free_photos' => 'required'
        ]);


        Booking::create([
            'id' => Str::uuid()->toString(),
            'title' => $request->title,
            'date' => $request->date,
            'price_per_photo' => $request->price_per_photo,
            'numof_free_photos' => $request->numof_free_photos,
        ]);
        return redirect()->route('admin.booking.index')->with(['ok' => 'De boeking is aangemaakt.']);
    }

    function edit($id) {

        try {
            return view('admin.booking.edit', [
                'booking' => Booking::findOrFail($id)
            ]);
        } catch (\Exception $_) {

        }
        return redirect()->route('admin.booking.index')->with('fail', 'Boeking niet gevonden.');

    }

    /**
     * @throws \Exception
     */
    function update($id) {
        $request = request();

        $request->validate([
            'title' => 'required|unique:bookings,title,' . $id,
            'date' => 'required|date',
            'price_per_photo' => 'required|numeric',
            'numof_free_photos' => 'required|numeric',
        ]);

        try {
            $booking = Booking::findOrFail($id);
            $booking->title = $request->title;
            $booking->date = $request->date;
            $booking->price_per_photo = $request->price_per_photo;
            $booking->numof_free_photos = $request->numof_free_photos;
            $booking->save();
            return redirect()->route('admin.booking.index')->with(['ok' => 'De boeking is bewerkt.']);

        } catch (\Exception $e) {
            throw $e;
        }

    }

    /**
     * @throws \Exception
     */
    function delete($id) {
        try {
            $booking = Booking::findOrFail($id);

            foreach ($booking->photos as $photo) {

                if (Storage::exists('uploads/' . $photo->fileName)) {
                    Storage::delete('uploads/' . $photo->fileName);
                }
                if (Storage::exists('watermarked/' . $photo->fileName)) {
                    Storage::delete('watermarked/' . $photo->fileName);
                }

                $photo->delete();
            }

            $booking->delete();

            return redirect()->route('admin.booking.index')->with(['ok' => 'De boeking is verwijderd.']);

        } catch (\Exception $e) {
            throw $e;
        }

    }

}
