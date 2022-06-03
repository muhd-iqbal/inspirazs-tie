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
            $table->id()->startingValue(1001);
            $table->string('method', 10);
            $table->string('customer_name');
            $table->string('customer_organisation')->nullable();
            $table->string('customer_address');
            $table->string('customer_postcode', 5);
            $table->string('customer_city', 50);
            $table->string('customer_state', 50);
            $table->string('customer_phone', 15);
            $table->string('customer_email', 100);
            $table->integer('weight');
            $table->integer('total');
            $table->integer('shipping');
            $table->integer('grand_total');
            $table->string('hash');
            $table->timestamps();
        });
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->string('product');
            $table->integer('quantity');
            $table->integer('price');
            $table->integer('total');
            $table->text('note')->nullable();
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
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
    }
};
