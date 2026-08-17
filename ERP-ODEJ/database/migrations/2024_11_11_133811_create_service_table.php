<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('service', function (Blueprint $table) {
            $table->comment('TRIAL');
            $table->double('id_service', null, 0)->nullable()->unique('primarykey')->comment('TRIAL');
            $table->integer('code_service')->nullable()->index('codeservice')->comment('TRIAL');
            $table->string('nom_service')->nullable()->comment('TRIAL');
            $table->char('trial746', 1)->nullable()->comment('TRIAL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service');
    }
};
