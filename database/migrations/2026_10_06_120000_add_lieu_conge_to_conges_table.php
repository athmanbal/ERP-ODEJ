<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('conges', function (Blueprint $table) {
            // "عنوان مكان قضاء العطلة" : adresse du lieu où le congé sera passé
            $table->string('lieu_conge')->nullable()->after('motif');
        });
    }

    public function down(): void
    {
        Schema::table('conges', function (Blueprint $table) {
            $table->dropColumn('lieu_conge');
        });
    }
};
