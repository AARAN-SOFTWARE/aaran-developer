<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        if (Aaran\Aadmin\Src\Customise::hasIssueManagement()) {

            Schema::create('issues', function (Blueprint $table) {
                $table->id();
                $table->string('vname');
                $table->longText('body')->nullable();
                $table->foreignId('module_id')->references('id')->on('commons');
                $table->foreignId('assignee_id')->references('id')->on('users');
                $table->foreignId('priority_id')->references('id')->on('commons');
                $table->foreignId('status_id')->references('id')->on('commons');
                $table->string('due_date')->nullable();
                $table->string('active_id', 3)->nullable();
                $table->foreignId('reporter_id')->references('id')->on('users');
                $table->string('flag')->nullable();
                $table->string('verified')->nullable();
                $table->string('verified_on')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('issues');
    }
};
