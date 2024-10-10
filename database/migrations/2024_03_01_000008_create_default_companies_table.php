<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Aaran\Aadmin\Src\Customise::hasCommon()) {

            Schema::create('default_companies', function (Blueprint $table) {
                $table->id();
                $table->foreignId('company_id')->nullable();
                $table->unsignedBigInteger('tenant_id')->nullable();
                $table->longText('acyear');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('default_companies');
    }
};
