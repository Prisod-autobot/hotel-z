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
        Schema::create('room_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->integer('cost_per_day');
            $table->integer('discount_percentage')->default(0);
            $table->integer('size')->nullable();
            $table->integer('max_adult')->nullable()->default(0);
            $table->integer('max_child')->nullable()->default(0);
            $table->text('description')->nullable();
            $table->boolean('room_service')->default(true);
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('room_types');
    }
};