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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('medicalRecordNumber');
            $table->string('name');
            $table->date('birth_date');
            $table->string('gender');
            $table->string('profileImage')->default('https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png');
            $table->string('phoneNumber');
            $table->string('email');
            $table->string('address');
            $table->string('disease');
            $table->string('note');
            $table->timestamps();
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
};
