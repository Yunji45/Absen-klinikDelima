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
        Schema::create('rubahjadwals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->enum('permohonan',['ganti_jaga','tukar_jaga','lembur'])->default('ganti_jaga')->nullable();
            $table->string('pengganti')->nullable();
            $table->date ('tanggal')->nullable();
            $table->string('alasan')->nullable();
            $table->enum('status',['pengajuan','approve'])->default('pengajuan');
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
        Schema::dropIfExists('rubahjadwals');
    }
};
