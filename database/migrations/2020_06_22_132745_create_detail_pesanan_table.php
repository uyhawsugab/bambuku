<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pesanan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_pesanan')->unsigned();
            $table->integer('id_barang')->unsigned();
            $table->integer('jumlah')->unsigned();
            $table->enum('status', ['Dipesan', 'Sedang diantar', 'Sudah diantar']);
            $table->timestamps();

            $table->foreign('id_pesanan')->references('id')->on('pesanan')->onDelete('cascade');
            $table->foreign('id_barang')->references('id')->on('barang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_pesanan');
    }
}
