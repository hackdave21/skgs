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
        Schema::table('users', function (Blueprint $table) {
        $table->unsignedBigInteger('school_classe_id')->nullable();
        $table->unsignedBigInteger('subject_id')->nullable();

        // Ajouter les clés étrangères si nécessaire
        $table->foreign('school_classe_id')->references('id')->on('school_classes');
        $table->foreign('subject_id')->references('id')->on('subjects');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
        $table->dropForeign(['school_classe_id']);
        $table->dropForeign(['subject_id']);
        $table->dropColumn(['school_classe_id', 'subject_id']);
        });
    }
};
