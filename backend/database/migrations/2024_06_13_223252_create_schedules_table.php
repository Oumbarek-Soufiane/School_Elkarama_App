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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('teacher_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('class_room_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->time('start_time');
            $table->time('end_time');
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};