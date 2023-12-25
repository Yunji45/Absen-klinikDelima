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
        Schema::create('kategori_jasa_medis', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_layanan')->nullable();
            $table->string('jenis_jasa')->nullable();
            $table->integer('tarif_jasa')->nullable();
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
        Schema::dropIfExists('kategori_jasa_medis');
    }
};
