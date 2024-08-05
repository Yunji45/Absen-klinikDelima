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
        DB::statement("ALTER TABLE users MODIFY role ENUM('admin', 'pegawai', 'hrd', 'evaluator', 'keuangan', 'IT')");
        // Schema::table('users', function (Blueprint $table) {
        //     $table->enum('role', ['hrd', 'evaluator', 'keuangan']);
        // });
        //inputer
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // $table->dropColumn('role');
        });
    }
};
