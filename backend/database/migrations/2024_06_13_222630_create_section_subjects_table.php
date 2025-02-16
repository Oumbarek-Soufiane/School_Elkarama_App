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
        Schema::create('section_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('hours_per_week');
            $table->integer('coefficient');
            $table->timestamps();
            $table->unique(['subject_id', 'section_id','hours_per_week','coefficient'], 'eval_unique_idx');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section_subjects');
    }
};