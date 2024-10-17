<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('project_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_task_id')->references('id')->on('project_tasks')->onDelete('cascade');
            $table->string('vname');
            $table->longText('description')->nullable();
            $table->decimal('active_id',3);
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('project_activities');
    }
};
