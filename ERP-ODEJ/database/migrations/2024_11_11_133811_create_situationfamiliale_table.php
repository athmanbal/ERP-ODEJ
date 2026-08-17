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
        Schema::create('situationfamiliale', function (Blueprint $table) {
            $table->comment('TRIAL');
            $table->double('id_situationfamiliale', null, 0)->nullable()->unique('primarykey')->comment('TRIAL');
            $table->string('nomsituationfamiliale')->nullable()->comment('TRIAL');
            $table->char('trial746', 1)->nullable()->comment('TRIAL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('situationfamiliale');
    }
};
