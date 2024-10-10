<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        if (Aaran\Aadmin\Src\Customise::hasMaster()) {
            Schema::create('company_details', function (Blueprint $table) {
                $table->id();
                $table->foreignId('company_id')->references('id')->on('companies')->onDelete('cascade');
                $table->string('address_type')->nullable();
                $table->string('address_1')->nullable();
                $table->string('address_2')->nullable();
                $table->foreignId('city_id')->references('id')->on('commons');
                $table->foreignId('state_id')->references('id')->on('commons');
                $table->foreignId('pincode_id')->references('id')->on('commons');
                $table->foreignId('country_id')->references('id')->on('commons');
                $table->timestamps();
            });
        }
    }


    public function down(): void
    {
        Schema::dropIfExists('company_details');
    }
};
