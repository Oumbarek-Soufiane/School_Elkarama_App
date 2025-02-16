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
        Schema::create("num_groupes", function (blueprint $table) {
            $table->id();
            $table->foreignId("filiere_id")->constrained()->onDelete('cascade');
            $table->integer("a_affecter");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('num_groupes');
    }
};
