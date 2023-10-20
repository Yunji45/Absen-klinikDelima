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
        Schema::create('ach_kpis', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('daftar')->nullable();
            $table->integer('poli')->nullable();
            $table->integer('farmasi')->nullable();
            $table->integer('kasir')->nullable();
            $table->integer('care')->nullable();
            $table->integer('bpjs')->nullable();
            $table->integer('khitan')->nullable();
            $table->integer('rawat')->nullable();
            $table->integer('salin')->nullable();
            $table->integer('lab')->nullable();
            $table->integer('umum')->nullable();
            $table->integer('visit')->nullable();
            $table->integer('tambah1')->nullable();
            $table->integer('tambah2')->nullable();
            $table->integer('tambah3')->nullable();
            $table->integer('tambah4')->nullable();
            $table->integer('tambah5')->nullable();
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
        Schema::dropIfExists('ach_kpis');
    }
};
