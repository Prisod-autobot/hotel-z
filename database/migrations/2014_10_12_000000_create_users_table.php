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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->enum('gender', ['male', 'female', 'others'])->nullable();
            $table->string('phone', 15)->nullable();
            $table->text('address')->nullable();
            $table->string('email', 50)->unique()->nullable();
            $table->string('password', 200)->nullable();
            $table->string('avatar', 200)->nullable();
            $table->enum('level', ['admin', 'member'])->default('member');
            $table->boolean('status')->default(true);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};