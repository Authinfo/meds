<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nomor_order');
            $table->date('tanggal_permintaan');
            $table->string('status_booking')->nullable();
            $table->string('jenis_booking');
            $table->string('nama_orang_lain')->nullable();
            $table->string('email_orang_lain')->nullable();
            $table->string('nomor_identitas_orang_lain')->nullable();
            $table->date('dob_orang_lain')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
