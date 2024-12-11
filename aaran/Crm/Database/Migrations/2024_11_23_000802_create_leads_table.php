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
            $table->string('vname');
            $table->foreignId('lead_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('body');
            $table->string('status_id',3)->nullable();
            $table->string('softwareType_id',3)->nullable();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('assignee_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('active_id', 3);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
