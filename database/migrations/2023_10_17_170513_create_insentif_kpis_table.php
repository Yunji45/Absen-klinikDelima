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
        Schema::create('insentif_kpis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->date('bulan')->nullable();
            $table->integer('omset')->nullable();
            $table->integer('total_poin')->nullable();
            $table->integer('total_insentif')->nullable();
            $table->integer('index_rupiah')->nullable();
            $table->integer('insentif_final')->nullable();
            $table->integer('poin_user')->nullable();
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
        Schema::dropIfExists('insentif_kpis');
    }
};
