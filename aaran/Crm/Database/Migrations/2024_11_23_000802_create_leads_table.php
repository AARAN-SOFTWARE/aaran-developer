<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enquiry_id')->references('id')->on('enquiries')->onDelete('cascade');
//            $table->string('vname');
            $table->string('title');
            $table->foreignId('lead_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('body')->nullable();
            $table->string('softwareType_id')->references('id')->on('commons')->onDelete('cascade');
            $table->json('questions')->nullable();
//            $table->foreignId('questions_id')->references('id')->on('questions')->onDelete('cascade')->nullable();
            $table->foreignId('verified_by')->references('id')->on('users')->onDelete('cascade')->nullable();
            $table->string('active_id', 3);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
