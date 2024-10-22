<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('activities', function (Blueprint $table) {
           $table->string('verified')->after('remarks')->nullable();
           $table->date('verified_on')->after('verified')->nullable();
        });
    }


    public function down(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn('verified');
            $table->dropColumn('verified_on');
        });
    }
};
