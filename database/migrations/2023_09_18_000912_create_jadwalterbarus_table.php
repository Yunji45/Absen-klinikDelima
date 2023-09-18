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
        Schema::create('jadwalterbarus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('bulan')->nullable();
            $table->date('masa_aktif')->nullable();
            $table->date('masa_akhir')->nullable();
            for ($i = 1; $i <= 31; $i++) {
                $namaKolom = 'j' . $i;
                $table->enum($namaKolom, ['PS','PM', 'SM', 'L1', 'L2', 'C', 'IJ','LL','MM'])->nullable();
            }
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
        Schema::dropIfExists('jadwalterbarus');
    }
};
