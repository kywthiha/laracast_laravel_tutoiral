<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abilities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('ability_role', function (Blueprint $table) {
            $table->primary(['role_id','ability_id']);
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('ability_id');
            $table->timestamps();
            $table->foreign('role_id')->on('roles')->references('id')->onDelete('cascade');
            $table->foreign('ability_id')->on('abilities')->references('id')->onDelete('cascade');
        });

        Schema::create('role_user', function (Blueprint $table) {
            $table->primary(['user_id','role_id']);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('role_id');
            $table->timestamps();
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');
            $table->foreign('role_id')->on('roles')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('abilities');
    }
}
