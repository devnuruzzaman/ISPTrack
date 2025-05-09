<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('roles', function (Blueprint $table) {
        $table->id();
        $table->string('name')->unique();
        $table->string('guard_name')->default('web');
        $table->string('description')->nullable();
        $table->timestamps();
    });

    Schema::create('permissions', function (Blueprint $table) {
        $table->id();
        $table->string('name')->unique();
        $table->string('guard_name')->default('web');
        $table->string('description')->nullable();
        $table->timestamps();
    });

    Schema::create('role_user', function (Blueprint $table) {
        $table->foreignId('role_id')->constrained()->onDelete('cascade');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->primary(['role_id', 'user_id']);
    });

    Schema::create('permission_user', function (Blueprint $table) {
        $table->foreignId('permission_id')->constrained()->onDelete('cascade');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->primary(['permission_id', 'user_id']);
    });

    Schema::create('role_has_permissions', function (Blueprint $table) {
        $table->foreignId('permission_id')->constrained()->onDelete('cascade');
        $table->foreignId('role_id')->constrained()->onDelete('cascade');
        $table->primary(['permission_id', 'role_id']);
    });
}
};
