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
        Schema::create('gajis', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('id_karyawan')->nullable();
            $table->string('total')->nullable();
            $table->string('status')->nullable();
            $table->string('more')->nullable();
            $table->string('information')->nullable();
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
        Schema::dropIfExists('gajis');
    }
};
