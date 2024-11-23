<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_id')->references('id')->on('contacts');
            $table->foreignId('plan_id')->references('id')->on('commons');
            $table->foreignId('software_type_id')->references('id')->on('commons');
            $table->foreignId('service_id')->references('id')->on('commons');
            $table->foreignId('bank_id')->references('id')->on('commons')->onDelete('cascade');
            $table->foreignId('status_id',3)->nullable();
            $table->foreignId('vdate')->nullable();
            $table->string('vname');
            $table->string('remarks');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
