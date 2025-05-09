<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sms_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('template_id')->nullable()->constrained('sms_templates');
            $table->foreignId('client_id')->nullable()->constrained();
            $table->string('phone_number');
            $table->text('message');
            $table->enum('status', ['pending', 'sent', 'failed', 'delivered'])->default('pending');
            $table->string('gateway')->nullable();
            $table->string('message_id')->nullable(); // SMS Gateway message ID
            $table->datetime('sent_at')->nullable();
            $table->datetime('delivered_at')->nullable();
            $table->text('error_message')->nullable();
            $table->json('response_data')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
            $table->index(['client_id', 'created_at']);
            $table->index(['status', 'created_at']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('sms_logs');
    }
};