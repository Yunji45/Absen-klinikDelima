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
            $table->string('div')->nullable();
            $table->string('daftar')->nullable();
            $table->string('poli')->nullable();
            $table->string('farmasi')->nullable();
            $table->string('kasir')->nullable();
            $table->string('care')->nullable();
            $table->string('bpjs')->nullable();
            $table->string('khitan')->nullable();
            $table->string('rawat')->nullable();
            $table->string('persalinan')->nullable();
            $table->string('lab')->nullable();
            $table->string('umum')->nullable();
            $table->string('visit')->nullable();
            $table->string('layanan')->nullable();
            $table->string('akuntan')->nullable();
            $table->string('kompeten')->nullable();
            $table->string('harmonis')->nullable();
            $table->string('loyal')->nullable();
            $table->string('adaptif')->nullable();
            $table->string('kolaboratif')->nullable();
            $table->string('absen')->nullable();
            $table->integer('total')->nullable();

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
