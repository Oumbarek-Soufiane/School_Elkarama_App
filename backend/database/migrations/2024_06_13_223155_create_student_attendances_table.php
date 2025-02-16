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
        Schema::create('student_attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('teacher_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->boolean('is_present')->default(true);
            $table->string('reason_if_absent')->nullable();
            $table->boolean('has_justification_if_absent')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_attendances');
    }
};