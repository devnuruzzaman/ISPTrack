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
        Schema::create('network_links', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_device_id');
            $table->unsignedBigInteger('to_device_id');
            $table->string('status')->nullable();
            $table->float('bandwidth')->nullable();
            $table->timestamps();

            $table->foreign('from_device_id')->references('id')->on('network_devices')->onDelete('cascade');
            $table->foreign('to_device_id')->references('id')->on('network_devices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('network_links');
    }
};
