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
        Schema::create('invites', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->date('dateNaissance');
            $table->string('numeroTelephone');
            $table->enum('genre', ['M', 'F']);
            $table->enum('situationFamiliale', ['marier', 'celibataire', 'divorcer']);
            $table->float('moyenneDernierAnnee');
            $table->string('filiereActuelle');
            $table->foreignId("filiere_id")->constrained()->onDelete('cascade');
            $table->string('couvertureMedicale')->nullable();;
            $table->string('photo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invites');
    }
};
