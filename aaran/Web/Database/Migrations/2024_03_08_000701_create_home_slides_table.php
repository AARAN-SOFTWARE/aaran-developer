<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('home_slides', function (Blueprint $table) {
            $table->id();
            $table->string('vname');
            $table->longText('description');
            $table->string('link')->nullable();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('active_id')->nullable();
            $table->longText('bg_image')->nullable();
            $table->longText('cont_image')->nullable();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('home_slides');
    }
};
