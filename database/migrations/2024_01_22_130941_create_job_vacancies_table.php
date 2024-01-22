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
        Schema::create('job_vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('category')->nullable();
            $table->string('position')->nullable();
            $table->string('deskripsi')->nullable();
            $table->string('kualifikasi_1')->nullable();
            $table->string('kualifikasi_2')->nullable();
            $table->string('kualifikasi_3')->nullable();
            $table->string('kualifikasi_4')->nullable();
            $table->string('kualifikasi_5')->nullable();
            $table->string('kualifikasi_6')->nullable();
            $table->string('kualifikasi_7')->nullable();
            $table->string('kualifikasi_8')->nullable();
            $table->string('kualifikasi_9')->nullable();
            $table->string('kualifikasi_10')->nullable();
            $table->date('bulan')->nullable();
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
        Schema::dropIfExists('job_vacancies');
    }
};
