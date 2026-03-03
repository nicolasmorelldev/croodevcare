<?php

use App\Enums\DonationStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cause_id')->constrained()->cascadeOnDelete();
            $table->foreignId('donation_method_id')->nullable()->constrained()->nullOnDelete();
            $table->string('gateway_type')->nullable()->index();
            $table->string('donor_name');
            $table->string('donor_email');
            $table->string('donor_phone')->nullable();
            $table->text('message')->nullable();
            $table->unsignedBigInteger('amount');
            $table->string('currency', 3)->default('ARS');
            $table->string('status')->default(DonationStatus::Pending->value)->index();
            $table->string('provider_reference')->nullable()->index();
            $table->string('transaction_reference')->nullable()->index();
            $table->json('payload')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
