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
        Schema::create('chefs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chef_id');
            $table->string('fname');
            $table->string('lname');
            $table->string('mobile')->nullable();
            $table->string('address')->nullable();
            $table->string('bio')->nullable();
            $table->timestamps();
            $table->string('avatar')->nullable();

            $table->foreign('chef_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chefs');
    }
};
