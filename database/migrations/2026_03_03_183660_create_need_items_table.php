<?php

use App\Enums\NeedCategory;
use App\Enums\NeedStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('need_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cause_id')->constrained()->cascadeOnDelete();
            $table->string('category')->default(NeedCategory::Other->value)->index();
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('estimated_amount')->default(0);
            $table->unsignedBigInteger('covered_amount')->default(0);
            $table->string('status')->default(NeedStatus::Pending->value)->index();
            $table->boolean('urgent')->default(false)->index();
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('need_items');
    }
};
