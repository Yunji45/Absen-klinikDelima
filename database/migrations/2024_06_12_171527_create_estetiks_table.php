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
        Schema::create('estetiks', function (Blueprint $table) {
            $table->id();
            $table->datetime('tgl_kunjungan')->nullable();
            $table->string('no_rm')->nullable();
            $table->string('name')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('poli')->nullable();
            $table->text('alamat')->nullable();
            // $table->unsignedBigInteger('kode_wilayah');
            // $table->foreign('kode_wilayah')->references('id')->on('kode_wilayahs');
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
        Schema::dropIfExists('estetiks');
    }
};
