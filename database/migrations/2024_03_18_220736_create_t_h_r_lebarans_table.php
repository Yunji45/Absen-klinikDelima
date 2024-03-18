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
        Schema::create('t_h_r_lebarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->date('bulan')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('gaji_terakhir')->nullable();
            $table->date('masuk')->nullable();
            $table->date('keluar')->nullable();
            $table->string('masa_kerja')->nullable();
            $table->string('index')->nullable();
            $table->string('THR')->nullable();
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
        Schema::dropIfExists('t_h_r_lebarans');
    }
};
