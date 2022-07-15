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
        Schema::create('orders_items', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->string('title');
            $table->integer('product_id');
            $table->integer('point_id');

            // Цена на момент создания заказа
            $table->decimal('price', $precision = 8, $scale = 2);
            $table->integer('qty');
            $table->decimal('amount', $precision = 8, $scale = 2);

            $table->integer('status')->default(0);
            // Тут будут данные на момент заказа, что бы видеть snapshot [product, rest, point]
            $table->json('param')->nullable();
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
        Schema::dropIfExists('orders_items');
    }
};
