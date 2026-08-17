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
        Schema::create('irg', function (Blueprint $table) {
            $table->comment('TRIAL');
            $table->double('mensuel_soumis', null, 0)->nullable()->comment('TRIAL');
            $table->double('irg', null, 0)->nullable()->comment('TRIAL');
            $table->char('trial743', 1)->nullable()->comment('TRIAL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('irg');
    }
};
