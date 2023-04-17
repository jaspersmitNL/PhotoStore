<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        User::create([
            'email' => 'admin@photostore.dev',
            'name' => 'admin',
            'password' => Hash::make('123')
        ]);
        Booking::create([
            'id' => Str::uuid()->toString(),
            'title' => 'test',
            'date' => Carbon::now(),
            'price_per_photo' => 2.50,
            'numof_free_photos' => 2,
        ]);
    }
}
