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
        Schema::create('attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enquiry_id')->references('id')->on('enquiries')->onDelete('cascade');
            $table->string('attempt_no');
            $table->foreignId('lead_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('body');
            $table->string('status_id',3)->nullable();
            $table->foreignId('verified_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attempts');
    }
};
