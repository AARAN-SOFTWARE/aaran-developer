<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        if (Aaran\Aadmin\Src\Customise::hasIssueManagement()) {

            Schema::create('issue_activities', function (Blueprint $table) {
                $table->id();
                $table->longText('vname');
                $table->foreignId('reporter_id')->references('id')->on('users');
                $table->foreignId('status_id')->references('id')->on('commons');
                $table->string('active_id', 3)->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('issue_activities');
    }
};
