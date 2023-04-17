<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model {

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
        $this->id = explode("-", Str::uuid()->toString())[0];
    }


    protected $fillable = [
        'id',
        'booking_id',
        'mollie_payment_id',
        'isPaid',
        'price',
        'email',
        'first_name',
        'last_name',
        'photos'
    ];

    protected $casts = [
        'photos' => 'string'
    ];

    public function booking() {
        return $this->belongsTo(Booking::class);
    }

}
