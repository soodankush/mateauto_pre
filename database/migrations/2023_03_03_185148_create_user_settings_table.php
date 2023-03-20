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
        Schema::create('user_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('platform_id');
            $table->json('credentials')->nullable();
            $table->boolean('status');
            $table->json('payload')->comments('Payload which is sent during OAuth')->nullable();
            $table->json('platform_user_details')->comments('User details related to platform')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('platform_id')->references('id')->on('platforms');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('user_settings');
    }
};
