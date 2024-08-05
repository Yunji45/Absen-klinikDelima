<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cutis', function (Blueprint $table) {
            DB::statement("ALTER TABLE cutis MODIFY COLUMN jenis_izin ENUM('cuti_tahunan', 'sakit', 'izin', 'cuti_bersama', 'cuti_melahirkan', 'cuti_besar', 'cuti_menikah')");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cutis', function (Blueprint $table) {
            DB::statement("ALTER TABLE cutis MODIFY COLUMN jenis_izin ENUM('cuti_tahunan', 'sakit', 'izin', 'cuti_bersama', 'cuti_melahirkan', 'cuti_besar')");
        });
    }
};
