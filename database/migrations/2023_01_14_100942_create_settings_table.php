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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->nullable()->default(null);
            $table->string('site_title')->nullable()->default(null);
            $table->boolean('sidebar_collapse')->default(false);
            $table->string('site_address')->nullable()->default(null);
            $table->string('site_mobile')->nullable()->default(null);
            $table->string('site_email')->nullable()->default(null);
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
        Schema::dropIfExists('settings');
    }
};
