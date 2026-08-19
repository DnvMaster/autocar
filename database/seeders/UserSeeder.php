<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('slug', 'super-admin')->first();
        $managerRole = Role::where('slug', 'manager')->first();
        $accountantRole = Role::where('slug', 'accountant')->first();
        $fleetRole = Role::where('slug', 'fleet-manager')->first();
        $admin = User::updateOrCreate(
            ['email' => 'admin@autocar.loc'],
            ['name' => 'Виктор Павлов','password' => Hash::make('password')]
        );
        $manager = User::updateOrCreate(
            ['email' => 'manager@autocar.loc'],
            ['name' => 'Виктория Игоревна','password' => Hash::make('password')]
        );
        $accountant = User::updateOrCreate(
            ['email' => 'accountant@autocar.loc'],
            ['name' => 'Светлана Васильевна','password' => Hash::make('password')]
        );
        $fleetManager = User::updateOrCreate(
            ['email' => 'fleet@autocar.loc'],
            ['name' => 'Сергей Фёдорович','password' => Hash::make('password')]
        );
        $admin->roles()->syncWithoutDetaching([$adminRole->id]);
        $manager->roles()->syncWithoutDetaching([$managerRole->id]);
        $accountant->roles()->syncWithoutDetaching([$accountantRole->id]);
        $fleetManager->roles()->syncWithoutDetaching([$fleetRole->id]);
    }
}
