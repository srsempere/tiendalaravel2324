<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ivas', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['normal', 'reducido', 'super_reducido']);
            $table->unsignedInteger('por');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE ivas ADD CONSTRAINT chk_por_range CHECK (por >= 0 AND por <= 100)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ivas');
    }
};
