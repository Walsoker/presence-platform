<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Créer les départements
        $deptInformatique = Department::create(['name' => 'Informatique']);
        $deptRH = Department::create(['name' => 'Ressources Humaines']);

        // 2. Créer l'administrateur (pas de département)
        User::create([
            'name' => 'Admin Principal',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 3. Créer les chefs de département
        $chefInfo = User::create([
            'name' => 'Chef Informatique',
            'email' => 'chef.info@example.com',
            'password' => Hash::make('password'),
            'role' => 'chef',
            'department_id' => $deptInformatique->id,
        ]);

        $chefRH = User::create([
            'name' => 'Chef RH',
            'email' => 'chef.rh@example.com',
            'password' => Hash::make('password'),
            'role' => 'chef',
            'department_id' => $deptRH->id,
        ]);

        // 4. Créer des utilisateurs simples (membres des départements)
        User::create([
            'name' => 'Alice Dupont',
            'email' => 'alice@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'department_id' => $deptInformatique->id,
        ]);

        User::create([
            'name' => 'Bob Martin',
            'email' => 'bob@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'department_id' => $deptInformatique->id,
        ]);

        User::create([
            'name' => 'Claire Legrand',
            'email' => 'claire@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'department_id' => $deptRH->id,
        ]);
    }
}