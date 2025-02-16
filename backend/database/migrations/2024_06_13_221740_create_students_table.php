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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guardian_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('section_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('group_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('cne')->nullable()->unique();
            $table->string('student_first_name');
            $table->string('student_last_name');
            $table->date('student_date_of_birth');
            $table->string('student_city_of_birth');
            $table->string('student_country_of_birth');
            $table->enum('student_gender', ['male', 'female']);
            $table->string('student_address');
            $table->string('student_email')->unique();
            $table->string('student_password');
            $table->string('student_phone_number')->nullable();
            $table->string('student_nationality');
            $table->boolean('needs_transportation')->default(false);
            $table->text('student_illnesses')->nullable();
            $table->boolean('study_troubles');
            $table->text('study_troubles_description')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};