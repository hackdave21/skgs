<?php

namespace Database\Seeders;

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
        User::create([
            'first_name' => 'kodjo',
            'last_name' => 'KOKOU',
            'phone_number' => '93617132',
            'sex' => 'masculin',
            'diplome' => 'licence',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345p678'),
            'subject_id' => 1,
            'school_classe_id' => 1,
        ]);
    }
}
