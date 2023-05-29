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
        Schema::create('settings_komisi', function (Blueprint $table) {
            $table->double('omzet_start')->nullable();
            $table->string('operator');
            $table->double('omzet_end')->nullable();
            $table->float('komisi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings_komisi');
    }
};
