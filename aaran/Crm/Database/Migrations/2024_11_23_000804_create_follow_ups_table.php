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
            $table->foreignId('id_for_lead')->references('id')->on('leads')->onDelete('cascade');
            $table->string('vname'); // followup_no
            $table->foreignId('lead_id')->references('id')->on('users')->onDelete('cascade')->nullable();
            $table->string('feature');
            $table->string('team_members');
            $table->string('status')->nullable();
            $table->string('body')->nullable();  // report
            $table->foreignId('verified_by')->references('id')->on('users')->onDelete('cascade')->nullable();
            $table->string('active_id',3)->nullable();
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
