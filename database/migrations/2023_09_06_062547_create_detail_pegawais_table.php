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
        Schema::create('detail_pegawais', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('name')->nullable();
            $table->string('place_birth')->nullable();
            $table->date('date_birth')->nullable();
            $table->enum('gender',['Laki-Laki','Perempuan'])->nullable();
            $table->enum('religion',['Islam','Kristen','Hindu','Buddha','Konghucu'])->nullable();
            $table->enum('education',['SMK/SMA','D3/S1','S2','S3'])->nullable();
            $table->string('program_study')->nullable();
            $table->text('address')->nullable();
            $table->string('position')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->date('hire_date')->nullable();
            $table->string('length_of_service')->nullable();
            $table->date('exit_date')->nullable();
            $table->text('exit_reason')->nullable();
            $table->string('marital_status');
            $table->string('spouse_name')->nullable();
            $table->integer('number_of_children')->nullable();
            // $table->json('children_info')->nullable();
            $table->text('hobbies')->nullable();
            $table->text('skills')->nullable();
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
        Schema::dropIfExists('detail_pegawais');
    }
};
