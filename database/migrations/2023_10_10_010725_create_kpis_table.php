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
        Schema::create('kpis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->date('bulan')->nullable;
            $table->string('div')->nullable();
            $table->integer('daftar')->nullable();
            $table->integer('poli')->nullable();
            $table->integer('farmasi')->nullable();
            $table->integer('kasir')->nullable();
            $table->integer('care')->nullable();
            $table->integer('bpjs')->nullable();
            $table->integer('khitan')->nullable();
            $table->integer('rawat')->nullable();
            $table->integer('persalinan')->nullable();
            $table->integer('lab')->nullable();
            $table->integer('umum')->nullable();
            $table->integer('visit')->nullable();
            $table->integer('layanan')->nullable();
            $table->integer('akuntan')->nullable();
            $table->integer('kompeten')->nullable();
            $table->integer('harmonis')->nullable();
            $table->integer('loyal')->nullable();
            $table->integer('adaptif')->nullable();
            $table->integer('kolaboratif')->nullable();
            $table->integer('absen')->nullable();
            $table->integer('total')->nullable();
            $table->double('total_kinerja')->nullable();
            $table->string('ket')->nullable();
    
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
        Schema::dropIfExists('kpis');
    }
};
