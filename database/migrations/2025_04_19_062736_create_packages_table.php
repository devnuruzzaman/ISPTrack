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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique()->nullable(); // Optional unique code
            $table->decimal('speed', 10, 2)->default(0); // e.g., 20.00
            $table->string('speed_unit')->default('Mbps'); // Mbps, Kbps, etc.
            $table->decimal('price', 10, 2); // Monthly price
            $table->decimal('setup_fee', 10, 2)->default(0); // One-time setup fee
            $table->text('features')->nullable(); // Comma or line-separated features
            $table->text('description')->nullable(); // Optional package description
            $table->boolean('is_public')->default(true); // Publicly visible to users
            $table->boolean('is_active')->default(true); // Whether available for use
            $table->timestamps();
            $table->softDeletes(); // Soft delete support
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};