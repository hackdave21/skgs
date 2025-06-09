<?php

namespace Database\Seeders;

use App\Models\SchoolClasse;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
     /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'first_name' => 'John',
            'last_name' => 'DOE',
            'phone_number' => '90909090',
            'sex' => 'masculin',
            'diplome' => 'licence',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
            'subject_id' => 1,
            'school_classe_id' => 1,
        ]);

        // Récupérer toutes les matières et toutes les classes
        $subjects = Subject::all();
        $classes = SchoolClasse::all();

        // Attacher chaque matière à chaque classe pour cet enseignant
        foreach($subjects as $subject) {
            foreach($classes as $class) {
                $admin->subjects()->attach($subject->id, [
                    'school_classe_id' => $class->id
                ]);
            }
        }
    }
}
