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
        Schema::create('dataset_khitans', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_kunjungan')->nullable();
            $table->string('no_rm')->nullable();
            $table->string('name')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('poli')->nullable();
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
        Schema::dropIfExists('dataset_khitans');
    }
};
