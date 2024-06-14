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
        Schema::create('docs_apis', function (Blueprint $table) {
            $table->id();
            $table->string('api_name')->nullable();
            $table->string('function')->nullable();
            $table->string('method')->nullable();
            $table->string('url')->nullable();
            $table->string('content_type')->nullable();
            $table->string('time_out')->nullable();
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
        Schema::dropIfExists('docs_apis');
    }
};
