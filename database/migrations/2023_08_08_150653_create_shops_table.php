<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('name');
            $table->string('location');
            $table->string('city');
            $table->boolean('delivery');
            $table->boolean('pickup');
            $table->string('whatsapp');
            $table->text('description');
            $table->double('price');
            $table->double('rate');
            $table->unsignedBigInteger('owner_id')->unsigned();
            $table->timestamps();

            $table->foreign('owner_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};
