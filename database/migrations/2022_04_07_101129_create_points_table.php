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
        Schema::create('points', function (Blueprint $table) {
            $table->id();
            $table->integer('type_id')->default(1); ;
            $table->string('title');
            $table->string('slug');
            $table->longText('description');
            $table->string('thumb')->nullable();
            $table->longText('images')->nullable();
            $table->string('country');
            $table->string('city');
            $table->string('address');
            $table->string('map_longitude');
            $table->string('map_latitude');
            $table->string('map_zoom')->default(10);
            $table->string('area')->nullable();
            $table->integer('days')->default(1);
            $table->softDeletes();
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
        Schema::dropIfExists('points');
    }
};
