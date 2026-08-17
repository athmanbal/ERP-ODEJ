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
        Schema::create('grade', function (Blueprint $table) {
            $table->comment('TRIAL');
            $table->double('id_grade', null, 0)->nullable()->unique('primarykey')->comment('TRIAL');
            $table->integer('code_grade')->nullable()->index('codegrade')->comment('TRIAL');
            $table->string('nom_grade')->nullable()->comment('TRIAL');
            $table->decimal('bonification', 19, 4)->nullable()->comment('TRIAL');
            $table->char('trial739', 1)->nullable()->comment('TRIAL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grade');
    }
};
