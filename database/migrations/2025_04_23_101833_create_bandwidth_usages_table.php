<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bandwidth_usages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained();
            $table->foreignId('bandwidth_allocation_id')->constrained();
            $table->decimal('download', 10, 2)->default(0); // In MB
            $table->decimal('upload', 10, 2)->default(0); // In MB
            $table->decimal('total_usage', 10, 2)->default(0); // In MB
            $table->decimal('average_speed', 10, 2)->nullable(); // In Mbps
            $table->integer('session_time')->default(0); // In seconds
            $table->string('ip_address')->nullable();
            $table->string('mac_address')->nullable();
            $table->datetime('session_start')->nullable();
            $table->datetime('session_end')->nullable();
            $table->json('additional_data')->nullable(); // For storing any additional metrics
            $table->timestamps();
            $table->index(['client_id', 'created_at']);
            $table->index(['bandwidth_allocation_id', 'created_at']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('bandwidth_usages');
    }
};