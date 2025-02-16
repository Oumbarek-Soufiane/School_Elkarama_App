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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('teacher_cin');
            $table->string('teacher_first_name');
            $table->string('teacher_last_name');
            $table->date('teacher_date_of_birth');
            $table->string('teacher_place_of_birth');
            $table->enum('teacher_gender', ['male', 'female']);
            $table->string('teacher_address');
            $table->string('teacher_email')->unique();
            $table->string('teacher_password');
            $table->string('teacher_phone_number')->unique();
            $table->string('teacher_nationality');
            $table->string('teacher_image')->nullable();
            $table->string('teacher_diploma')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};