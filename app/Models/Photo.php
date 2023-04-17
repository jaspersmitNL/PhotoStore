<?php

namespace App\Models;

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;


class Photo extends Model {
    use HasFactory;


    protected $fillable = [
        'id',
        'booking_id',
        'fileName',
        'originalFileName',
        'mode',
        'width',
        'height',
    ];


    public function booking() {
        return $this->belongsTo(Booking::class);
    }


    public function toImageSRC(): string {
        $ext = explode('.', $this->fileName)[1];
        $base64 = base64_encode(Storage::get('uploads/' . $this->fileName));
        return "data:image/" . $ext . ";base64," . $base64;
    }

    public function toWatermarkedSRC(): string {

        $ext = explode('.', $this->fileName)[1];
        $base64 = base64_encode(Storage::get('watermarked/' . $this->fileName));
        return "data:image/" . $ext . ";base64," . $base64;
    }
}
