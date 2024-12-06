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
        Schema::create('kode_wilayahs', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->nullable();
            $table->string('wilayah')->nullable();
            $table->decimal('longitude', 25, 20)->nullable();
            $table->decimal('latitude', 25, 20)->nullable();
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
        Schema::dropIfExists('kode_wilayahs');
    }
};
