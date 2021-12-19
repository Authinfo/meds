<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingProductCategoryPivotTable extends Migration
{
    public function up()
    {
        Schema::create('booking_product_category', function (Blueprint $table) {
            $table->unsignedBigInteger('booking_id');
            $table->foreign('booking_id', 'booking_id_fk_5070494')->references('id')->on('bookings')->onDelete('cascade');
            $table->unsignedBigInteger('product_category_id');
            $table->foreign('product_category_id', 'product_category_id_fk_5070494')->references('id')->on('product_categories')->onDelete('cascade');
        });
    }
}
