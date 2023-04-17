<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;


class Booking extends Model {
    use HasFactory;


    protected $fillable = [
        'id',
        'title',
        'date',
        'price_per_photo',
        'numof_free_photos'
    ];

    public function photos() {
        return $this->hasMany(Photo::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }


}
