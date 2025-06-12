<?php

namespace Database\Seeders;

use App\Models\SchoolClasse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolClasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = [
            ['name' => '1ère']
        ];

        foreach ($classes as $class) {
            SchoolClasse::create($class);
        }
    }
}
