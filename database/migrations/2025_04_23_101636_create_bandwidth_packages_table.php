<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bandwidth_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->decimal('speed', 10, 2);
            $table->string('speed_unit')->default('Mbps');
            $table->decimal('data_limit', 10, 2)->nullable(); // In GB, null means unlimited
            $table->decimal('fair_usage_limit', 10, 2)->nullable(); // In GB
            $table->decimal('fair_usage_speed', 10, 2)->nullable(); // Speed after FUP
            $table->string('fair_usage_speed_unit')->default('Mbps');
            $table->json('time_restrictions')->nullable(); // For time-based packages
            $table->boolean('is_active')->default(true);
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bandwidth_packages');
    }
};