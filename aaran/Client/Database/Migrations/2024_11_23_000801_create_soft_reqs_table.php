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
        Schema::create('soft_reqs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_id')->references('id')->on('contacts')->onDelete('cascade');
            $table->foreignId('softType_id')->references('id')->on('commons')->onDelete('cascade');
            $table->foreignId('planType_id')->references('id')->on('commons')->onDelete('cascade');
            $table->foreignId('serviceType_id')->references('id')->on('commons')->onDelete('cascade');
            $table->string('vname');
            $table->smallInteger('status');
            $table->longText('image');
            $table->longText('remarks');
            $table->smallInteger('active_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soft_reqs');
    }
};
