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
        Schema::create('costproduksis', function (Blueprint $table) {
            $table->id();
            $table->string('id_produksi')->nullable();
            $table->string('name')->nullable();
            $table->string('price')->nullable();
            $table->string('status')->nullable();
            $table->string('qty')->nullable();
            $table->string('information')->nullable();
            $table->string('unit')->nullable();
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
        Schema::dropIfExists('costproduksis');
    }
};
