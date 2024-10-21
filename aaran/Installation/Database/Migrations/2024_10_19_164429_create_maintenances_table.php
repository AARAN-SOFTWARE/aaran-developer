<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('soft_installations_id')->references('id')->on('soft_installations');
            $table->string('vname');
            $table->string('latest_version');
            $table->string('vdate');
            $table->longText('notes')->nullable();
            $table->decimal('active_id',3)->nullable();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
