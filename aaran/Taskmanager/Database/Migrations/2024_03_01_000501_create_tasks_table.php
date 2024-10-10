<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Aaran\Aadmin\Src\Customise::hasTaskManager()) {

            Schema::create('tasks', function (Blueprint $table) {
                $table->id();
                $table->string('vname');
                $table->longText('body');
                $table->longText('image')->nullable();
                $table->foreignId('allocated')->references('id')->on('users')->onDelete('cascade');
                $table->string('status', 3)->nullable();
                $table->string('verified')->nullable();
                $table->string('verified_on')->nullable();
                $table->foreignId('user_id')->references('id')->on('users');
                $table->string('active_id', 3)->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
