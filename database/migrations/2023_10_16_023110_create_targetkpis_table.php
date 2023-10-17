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
        Schema::create('targetkpis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->date('bulan')->nullable();
            $table->integer('t_daftar')->nullable();
            $table->integer('r_daftar')->nullable();
            $table->integer('c_daftar')->nullable();
            $table->integer('t_poli')->nullable();
            $table->integer('r_poli')->nullable();
            $table->integer('c_poli')->nullable();
            $table->integer('t_farmasi')->nullable();
            $table->integer('r_farmasi')->nullable();
            $table->integer('c_farmasi')->nullable();
            $table->integer('t_kasir')->nullable();
            $table->integer('r_kasir')->nullable();
            $table->integer('c_kasir')->nullable();
            $table->integer('t_care')->nullable();
            $table->integer('r_care')->nullable();
            $table->integer('c_care')->nullable();
            $table->integer('t_bpjs')->nullable();
            $table->integer('r_bpjs')->nullable();
            $table->integer('c_bpjs')->nullable();
            $table->integer('t_khitan')->nullable();
            $table->integer('r_khitan')->nullable();
            $table->integer('c_khitan')->nullable();
            $table->integer('t_rawat')->nullable();
            $table->integer('r_rawat')->nullable();
            $table->integer('c_rawat')->nullable();
            $table->integer('t_salin')->nullable();
            $table->integer('r_salin')->nullable();
            $table->integer('c_salin')->nullable();
            $table->integer('t_lab')->nullable();
            $table->integer('r_lab')->nullable();
            $table->integer('c_lab')->nullable();
            $table->integer('t_umum')->nullable();
            $table->integer('r_umum')->nullable();
            $table->integer('c_umum')->nullable();
            $table->integer('t_visit')->nullable();
            $table->integer('r_visit')->nullable();
            $table->integer('c_visit')->nullable();
            $table->integer('t_absen')->nullable();
            $table->integer('r_absen')->nullable();
            $table->integer('c_absen')->nullable();
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
        Schema::dropIfExists('targetkpis');
    }
};
