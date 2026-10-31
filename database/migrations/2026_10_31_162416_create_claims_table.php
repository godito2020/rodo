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
        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            $table->string('claim_number', 50)->unique();
            $table->string('full_name', 150);
            $table->string('doc_type', 20)->default('DNI');
            $table->string('doc_number', 30);
            $table->string('phone', 30);
            $table->string('email', 150);
            $table->string('address', 255);
            $table->string('department', 100)->nullable();
            $table->string('province', 100)->nullable();
            $table->string('district', 100)->nullable();
            $table->boolean('is_minor')->default(false);
            $table->string('guardian_name', 150)->nullable();
            $table->string('guardian_doc', 30)->nullable();
            $table->enum('contracted_type', ['producto', 'servicio'])->default('producto');
            $table->decimal('claimed_amount', 12, 2)->nullable();
            $table->string('currency', 10)->default('USD');
            $table->text('product_description');
            $table->enum('claim_type', ['reclamo', 'queja'])->default('reclamo');
            $table->text('details');
            $table->text('consumer_request');
            $table->enum('status', ['pendiente', 'en_proceso', 'atendido'])->default('pendiente');
            $table->text('response_text')->nullable();
            $table->timestamp('responded_at')->nullable();
            $table->text('admin_notes')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('claims');
    }
};
