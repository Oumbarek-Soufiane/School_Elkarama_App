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
        Schema::create('transport_staff', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bus_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('cin');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('date_of_birth');
            $table->enum('gender', ['male', 'female']);
            $table->string('address');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('nationality');
            $table->enum('role', ['driver', 'assistant']); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transport_staff');
    }
};