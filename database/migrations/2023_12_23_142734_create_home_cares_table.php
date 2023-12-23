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
        Schema::create('home_cares', function (Blueprint $table) {
            $table->id();
            $table->string('No_HC')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->date('bulan')->nullable();
            $table->string('foto')->nullable();
            $table->string('nama_pasien')->nullable();
            $table->string('jenis_layanan')->nullable();
            $table->string('jenis_jasa')->nullable();
            $table->integer('tarif_jasa')->nullable();
            $table->string('ceklis')->nullable();//enum ya atau tidak
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
        Schema::dropIfExists('home_cares');
    }
};
