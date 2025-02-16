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
        Schema::create('student_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('section_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('school_year_id')->constrained('school_years')->cascadeOnDelete();
            $table->float('general_average')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->unique(['student_id', 'section_id', 'school_year_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_sections');
    }
};