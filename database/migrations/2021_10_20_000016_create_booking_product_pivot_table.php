<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingProductPivotTable extends Migration
{
    public function up()
    {
        Schema::create('booking_product', function (Blueprint $table) {
            $table->unsignedBigInteger('booking_id');
            $table->foreign('booking_id', 'booking_id_fk_5036245')->references('id')->on('bookings')->onDelete('cascade');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id', 'product_id_fk_5036245')->references('id')->on('products')->onDelete('cascade');
        });
    }
}
