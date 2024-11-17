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
                $table->foreignId('job_id')->references('id')->on('commons');
                $table->foreignId('module_id')->references('id')->on('commons');
                $table->string('title');
                $table->longText('body');
                $table->string('priority_id', 3)->nullable();
                $table->string('status_id', 3)->nullable();
                $table->string('due_date')->nullable();
                $table->foreignId('allocated_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreignId('reporter_id')->references('id')->on('users')->onDelete('cascade');
                $table->string('active_id', 3)->nullable();
                $table->string('flag')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
