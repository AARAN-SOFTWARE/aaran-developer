<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('homes', function (Blueprint $table) {
            $table->id();
            $table->string('vname');
            $table->longText('desc');
            $table->string('cover_title');
            $table->longText('cover_desc');
            $table->string('test_title');
            $table->longText('test_desc');
            $table->string('serve_title');
            $table->string('feats_title');
            $table->longText('feats_desc');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('homes');
    }
};
