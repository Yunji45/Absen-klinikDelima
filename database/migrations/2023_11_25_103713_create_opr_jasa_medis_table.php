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
        Schema::create('opr_jasa_medis', function (Blueprint $table) {
            $table->id();
            $table->string('No_RM')->nullable();
            $table->date('bulan')->nullable();
            $table->string('nama_pasien')->nullable();
            $table->string('jenis_layanan')->nullable();
            $table->string('jenis_jasa')->nullable();
            $table->integer('tarif_jasa')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('ceklis_tindakan')->nullable();//enum ya atau tidak
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
        Schema::dropIfExists('opr_jasa_medis');
    }
};
