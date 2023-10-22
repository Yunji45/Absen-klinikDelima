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
        Schema::create('omset_kliniks', function (Blueprint $table) {
            $table->id();
            $table->date('bulan')->nullable();
            $table->integer('omset')->nullable();
            $table->integer('skor')->nullable();
            $table->integer('index')->nullable();
            $table->integer('index_rupiah')->nullable();
            $table->integer('total_insentif')->nullable();
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
        Schema::dropIfExists('omset_kliniks');
    }
};
