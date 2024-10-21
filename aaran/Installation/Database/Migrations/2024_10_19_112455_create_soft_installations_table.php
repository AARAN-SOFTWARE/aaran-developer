<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('soft_installations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_id')->references('id')->on('contacts');
            $table->string('vname');
            $table->string('db_user')  ->nullable();
            $table->string('db_password')->nullable();
            $table->string('git_url')->nullable();
            $table->string('soft_version')->nullable();
            $table->string('status')->nullable();
            $table->string('install_date')->nullable();
            $table->decimal('active_id',3)->nullable();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('soft_installations');
    }
};
