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
        Schema::create('guardians', function (Blueprint $table) {
            $table->id();
            $table->string('guardian_cin')->unique();
            $table->string('guardian_first_name');
            $table->string('guardian_last_name');
            $table->string('guardian_email')->unique();
            $table->string('guardian_password');
            $table->string('guardian_phone')->unique();
            $table->string('guardian_address');
            $table->enum('guardian_gender', ['male', 'female']);
            $table->string('guardian_nationality');
            $table->string('guardian_relationship');
            $table->string('second_guardian_cin')->nullable()->unique();
            $table->string('second_guardian_first_name')->nullable();
            $table->string('second_guardian_last_name')->nullable();
            $table->string('second_guardian_email')->nullable();
            $table->string('second_guardian_phone')->nullable()->unique();
            $table->string('second_guardian_address')->nullable();
            $table->enum('second_guardian_gender', ['male', 'female'])->nullable();
            $table->string('second_guardian_nationality')->nullable();
            $table->string('second_guardian_relationship')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guardians');
    }
};