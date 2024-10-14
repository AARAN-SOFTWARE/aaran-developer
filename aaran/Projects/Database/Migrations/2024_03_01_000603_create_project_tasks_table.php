<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('project_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workflow_id')->references('id')->on('workflows');
            $table->string('vname');
            $table->longText('description')->nullable();
            $table->string('status')->nullable();
            $table->string('active_id',3)->nullable();
            $table->foreignId('assignee')->references('id')->on('users');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_tasks');
    }
};
