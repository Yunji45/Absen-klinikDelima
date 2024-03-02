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
        Schema::create('gajians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->date('bulan')->nullable();
            $table->string('pendidikan')->nullable();
            $table->unsignedBigInteger('umr_id');
            $table->foreign('umr_id')->references('id')->on('u_m_karyawans');
            $table->string('index')->nullable();
            $table->string('THP')->nullable();
            $table->string('Gaji')->nullable();
            $table->string('Ach')->nullable();
            $table->string('Bonus')->nullable();
            $table->string('Masa_kerja')->nullable();
            $table->string('Gaji_akhir')->nullable();
            $table->string('Potongan')->nullable();
            $table->string('status_admin')->nullable();
            $table->string('status_penerima')->nullable();
            $table->string('penyesuaian')->nullable();
            $table->string('masa_kerja_karyawan')->nullable();
            $table->date('bergabung')->nullable();
            $table->date('berakhir')->nullable();
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
        Schema::dropIfExists('gajians');
    }
};
