<?php

use App\Enums\CauseStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('causes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('beneficiary_name');
            $table->text('beneficiary_summary');
            $table->string('status')->default(CauseStatus::Draft->value)->index();
            $table->string('location')->nullable();
            $table->unsignedBigInteger('goal_amount')->default(0);
            $table->unsignedBigInteger('raised_amount')->default(0);
            $table->boolean('featured')->default(false)->index();
            $table->string('hero_badge')->nullable();
            $table->string('hero_heading')->nullable();
            $table->text('hero_excerpt')->nullable();
            $table->text('short_story')->nullable();
            $table->longText('full_story')->nullable();
            $table->text('impact_statement')->nullable();
            $table->string('primary_cta_label')->nullable();
            $table->string('secondary_cta_label')->nullable();
            $table->string('manager_name')->nullable();
            $table->string('manager_role')->nullable();
            $table->string('manager_contact_email')->nullable();
            $table->string('manager_contact_phone')->nullable();
            $table->text('donation_disclaimer')->nullable();
            $table->string('hero_image_path')->nullable();
            $table->string('hero_image_alt')->nullable();
            $table->timestamp('published_at')->nullable()->index();
            $table->timestamp('last_update_at')->nullable()->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('causes');
    }
};
