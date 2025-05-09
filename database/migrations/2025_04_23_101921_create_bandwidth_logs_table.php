<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bandwidth_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained();
            $table->foreignId('bandwidth_allocation_id')->constrained();
            $table->enum('action_type', [
                'speed_change',
                'fup_activated',
                'fup_deactivated',
                'suspended',
                'resumed',
                'expired',
                'renewed',
                'limit_exceeded',
                'manual_adjustment'
            ]);
            $table->decimal('old_speed', 10, 2)->nullable();
            $table->decimal('new_speed', 10, 2)->nullable();
            $table->string('speed_unit')->default('Mbps');
            $table->decimal('data_usage', 10, 2)->nullable(); // Current data usage when action occurred
            $table->foreignId('performed_by')->constrained('users');
            $table->text('reason')->nullable();
            $table->json('additional_data')->nullable();
            $table->timestamps();
            $table->index(['client_id', 'created_at']);
            $table->index(['bandwidth_allocation_id', 'created_at']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('bandwidth_logs');
    }
};