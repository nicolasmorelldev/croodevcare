<?php

use App\Enums\CollaborationType;
use App\Enums\InquiryStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('collaboration_inquiries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cause_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('collaboration_type')->default(CollaborationType::Other->value)->index();
            $table->text('message');
            $table->string('status')->default(InquiryStatus::New->value)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('collaboration_inquiries');
    }
};
