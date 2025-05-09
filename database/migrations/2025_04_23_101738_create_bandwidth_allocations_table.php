<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bandwidth_allocations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained();
            $table->foreignId('bandwidth_package_id')->constrained();
            $table->decimal('allocated_speed', 10, 2);
            $table->string('speed_unit')->default('Mbps');
            $table->decimal('data_limit', 10, 2)->nullable();
            $table->decimal('data_used', 10, 2)->default(0);
            $table->boolean('is_fup_active')->default(false);
            $table->datetime('fup_started_at')->nullable();
            $table->datetime('last_reset_at')->nullable();
            $table->enum('status', ['active', 'suspended', 'expired'])->default('active');
            $table->datetime('expires_at')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bandwidth_allocations');
    }
};