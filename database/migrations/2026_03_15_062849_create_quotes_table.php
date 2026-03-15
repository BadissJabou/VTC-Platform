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
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->string('client_name');
            $table->string('client_email');
            $table->string('client_phone');
            $table->string('service_type');
            $table->text('description');
            $table->decimal('estimated_price', 8, 2);
            $table->decimal('final_price', 8, 2)->nullable();
            $table->enum('status', ['pending', 'sent', 'accepted', 'rejected', 'expired'])->default('pending');
            $table->datetime('valid_until');
            $table->string('pdf_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
