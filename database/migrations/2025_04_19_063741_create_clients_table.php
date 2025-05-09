<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();

            // Foreign key relationships
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('client_type_id')->constrained();
            $table->foreignId('package_id')->constrained();
            $table->foreignId('connection_type_id')->constrained();
            $table->foreignId('protocol_type_id')->constrained();
            $table->foreignId('box_id')->constrained();

            // Client identifiers
            $table->string('client_id')->unique(); // internal client id
            $table->string('connection_id')->unique(); // externally used connection id

            // Client information
            $table->string('name');
            $table->string('company_name')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('phone')->unique();
            $table->string('alternate_phone')->nullable();
            $table->string('email')->nullable()->unique();

            // Address and license details
            $table->text('address');
            $table->string('installation_address');
            $table->string('nid_number')->nullable();
            $table->string('trade_license')->nullable();

            // Billing and financial details
            $table->decimal('monthly_bill', 10, 2);
            $table->decimal('setup_fee', 10, 2)->default(0);
            $table->integer('billing_cycle')->nullable()->comment('Day of month when bill is generated');
            $table->date('due_date')->nullable();
            $table->date('connection_date');

            // Network-related information
            $table->string('ip_address')->nullable();
            $table->string('mac_address')->nullable();

            // Additional notes and status
            $table->text('notes')->nullable();
            $table->enum('status', ['active', 'inactive', 'suspended', 'terminated'])->default('active');
            $table->boolean('is_active')->default(true);

            // Timestamps and Soft Deletes
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
