<?php

use App\Models\SchoolClasse;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
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
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Student::class);
            $table->foreignIdFor(Subject::class);
            $table->foreignIdFor(SchoolClasse::class);
            $table->foreignIdFor(User::class);
            $table->integer('note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
