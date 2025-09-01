<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'nom' => 'Administrateur',
                'prenom' => 'Super',
                'password' => Hash::make('Admin123!'), // change immédiatement en prod
                'role' => 'admin',
                'is_active' => true,
                ]        
        
        );
    }
}
