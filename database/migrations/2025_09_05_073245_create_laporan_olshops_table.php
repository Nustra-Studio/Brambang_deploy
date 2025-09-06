<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_olshops', function (Blueprint $table) {
            $table->id();
            $table->string('nama_laporan');
            $table->dateTime('tanggal_laporan');
            $table->decimal('jumlah_laporan', 15, 2);
            $table->string('keterangan_laporan')->nullable();
            $table->string('status_laporan');
            $table->string('kategori_laporan')->nullable();
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
        Schema::dropIfExists('laporan_olshops');
    }
};
