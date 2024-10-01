<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualanHeaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan_header', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_transaksi')->nullable();
            $table->string('tgl_transaksi')->nullable();
            $table->string('customer')->nullable();
            $table->string('total_bayar')->nullable();
            $table->string('ppn')->nullable();
            $table->string('grand_total')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penjualan_header');
    }
}
