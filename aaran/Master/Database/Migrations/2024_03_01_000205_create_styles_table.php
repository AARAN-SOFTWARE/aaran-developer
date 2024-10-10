<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {

            Schema::create('styles', function (Blueprint $table) {
                $table->id();
                $table->string('vname')->unique();
                $table->longText('desc')->nullable();
                $table->longText('image')->nullable();
                $table->foreignId('company_id')->references('id')->on('companies');
                $table->string('active_id', 3)->nullable();
                $table->timestamps();
            });
    }

    public function down(): void
    {
        Schema::dropIfExists('styles');
    }
};
