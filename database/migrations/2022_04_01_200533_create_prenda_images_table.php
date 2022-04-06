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
        Schema::create('prenda_images', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->boolean('destacada')->default(false);
            $table->unsignedBigInteger('prenda_id');
            $table->foreign('prenda_id')->references('id')->on('prendas')->onDelete('cascade');
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
        Schema::dropIfExists('prenda_images');
    }
};
