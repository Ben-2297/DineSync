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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->double('quantity');
            $table->string('total');
            $table->string('type');
            $table->string('status')->default('New');

            $table->foreignId('chef_id')->nullable()->constrained('chefs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('customers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onUpdate('cascade')->onDelete('cascade');
            
            $table->timestamps();
            $table->time("begin")->nullable();
            $table->time("end")->nullable();
            $table->time("timeframe")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
