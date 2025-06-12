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
        Schema::table('grades', function (Blueprint $table) {
            $table->dropColumn('note');

            $table->decimal('note1', 4, 2)->nullable();
            $table->decimal('note2', 4, 2)->nullable();
            $table->decimal('devoir', 4, 2)->nullable();
            $table->decimal('compos', 4, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('grades', function (Blueprint $table) {
            $table->dropColumn(['note1', 'note2', 'devoir', 'compos']);
            
            $table->integer('note');

        });
    }
};
