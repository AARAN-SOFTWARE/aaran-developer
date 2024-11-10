<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        if (Aaran\Aadmin\Src\Customise::hasIssueManagement()) {

            Schema::create('issue_images', function (Blueprint $table) {
                $table->id();
                $table->foreignId('issue_id')->references('id')->on('issues');
                $table->longText('image');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('issue_images');
    }
};
