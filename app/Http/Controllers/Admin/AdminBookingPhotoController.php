<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Photo;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


function watermark(\Intervention\Image\Image $img) {
//    $img->text('Watermark', $img->width() / 2, $img->height() / 2, function ($font) {
//        $font->file(resource_path('fonts/Roboto-Bold.ttf'));
//        $font->size(44);
//        $font->color('#f00000');
//        $font->align('center');
//        $font->valign('top');
//        $font->angle(45);
//    });

    $img->insert(storage_path('app/watermark.png'), 'bottom-right');
}


class AdminBookingPhotoController extends Controller {


    function index($id) {

        try {
            $booking = Booking::findOrFail($id);


            return view('admin.booking.photos.index', [
                'booking' => $booking,
            ]);

        } catch (\Exception $e) {

        }

        return redirect()->route('admin.booking.index')->with(['fail' => 'WHOOPS!, Something went wrong!']);
    }


    private function _handleFile($file, $id) {
        $fileName = time() . "-" . $file->getClientOriginalName();
        $file->storeAs('uploads/', $fileName);

        $img = Image::make(Storage::get('uploads/' . $fileName));



        $width = $img->width();
        $height = $img->height();
//
        if ($width > $height) {
            $mode = "landscape";
        } else if ($height > $width) {
            $mode = "portrait";
        } else {
            $mode = "square";
        }


        Photo::create([
            'id' => Str::uuid()->toString(),
            'booking_id' => $id,
            'fileName' => $fileName,
            'originalFileName' => $file->getClientOriginalName(),
            'width' => $width,
            'height' => $height,
            'mode' => $mode
        ]);


        $img->resize($width / env('CROP_FACTOR', 2), $height / env('CROP_FACTOR', 2));
//        $img->resize($width, $height);

        watermark($img);

        $img->save(storage_path('app/watermarked/' . $fileName));
    }

    function upload($id) {

        try {
            $request = request();

            $files = $request->file('file');


            if (is_array($files)) {
                foreach ($files as $file) {
                    $this->_handleFile($file, $id);
                }
            } else {
                $this->_handleFile($files, $id);
            }


        } catch (\Exception $e) {
        }

        return "ok";
    }

    function delete($id) {
        try {

            $photo = Photo::findOrFail($id);
            if (Storage::exists('uploads/' . $photo->fileName)) {
                Storage::delete('uploads/' . $photo->fileName);
            }

            $photo->delete();


            return back()->with([
                'ok' => 'De foto is successvol verwijderd.'
            ]);

        } catch (\Exception $e) {
            Log::error("Failed to delete image " . $e->getMessage());
        }

    }
}
