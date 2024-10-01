<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualanHeaderDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan_header_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_transaksi_id')->nullable();
            $table->string('kode_barang_id')->nullable();
            $table->string('qty')->nullable();
            $table->string('harga')->nullable();
            $table->string('kode_promo_id')->nullable();
            $table->string('discount')->nullable();
            $table->string('subtotal')->nullable();
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
        Schema::dropIfExists('penjualan_header_detail');
    }
}
