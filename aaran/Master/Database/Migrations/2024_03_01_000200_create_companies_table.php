<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Aaran\Aadmin\Src\Customise::hasMaster()) {

            Schema::create('companies', function (Blueprint $table) {
                $table->id();
                $table->string('vname')->unique();
                $table->string('display_name')->nullable();
                $table->string('address_1')->nullable();
                $table->string('address_2')->nullable();
                $table->string('mobile')->nullable();
                $table->string('landline')->nullable();
                $table->string('gstin')->nullable();
                $table->string('pan')->nullable();
                $table->string('email')->nullable();
                $table->string('website')->nullable();
                $table->foreignId('city_id')->references('id')->on('commons');
                $table->foreignId('state_id')->references('id')->on('commons');
                $table->foreignId('pincode_id')->references('id')->on('commons');
                $table->foreignId('country_id')->references('id')->on('commons');
                $table->string('bank')->nullable();
                $table->string('acc_no')->nullable();
                $table->string('ifsc_code')->nullable();
                $table->string('branch')->nullable();
                $table->string('inv_pfx')->nullable();
                $table->string('iec_no')->nullable();
                $table->string('msme_no')->nullable();
                $table->foreignId('msme_type_id')->references('id')->on('commons');
                $table->string('active_id', 3)->nullable();
                $table->foreignId('user_id')->references('id')->on('users');
                $table->foreignId('tenant_id')->references('id')->on('tenants');
                $table->longText('logo')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
