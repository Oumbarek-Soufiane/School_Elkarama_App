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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('teacher_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('school_year_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('evaluation_number'); 
            $table->string('type')->nullable();
            $table->date('date');
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->nullable();
            $table->integer('semester')->nullable(); 
            $table->timestamps();
            $table->unique(['subject_id', 'group_id', 'school_year_id', 'evaluation_number'], 'eval_unique_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};