<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration {
    public function up() {

        Schema::create('orders', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->uuid('booking_id')->nullable();
            $table->uuid('mollie_payment_id')->nullable();
            $table->boolean('isPaid');
            $table->double('price');
            $table->string('email');
            $table->string('first_name');
            $table->string('last_name');
            $table->json('photos');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('orders');
    }
}
