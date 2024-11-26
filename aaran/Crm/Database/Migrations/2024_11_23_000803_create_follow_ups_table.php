<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('follow_ups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->references('id')->on('leads')->onDelete('cascade');
            $table->string('vname');
            $table->longText('body');
            $table->foreignId('action_id')->references('id')->on('commons')->onDelete('cascade');
            $table->string('status_id');
            $table->string('priority_id');
            $table->string('active_id', 3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follow_ups');
    }
};
