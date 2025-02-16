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
        Schema::create('marks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evaluation_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->float('score');
            $table->string('comment')->nullable();
            $table->timestamps();
            $table->unique(['evaluation_id', 'student_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marks');
    }
};