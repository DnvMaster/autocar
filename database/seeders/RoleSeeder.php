<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Супер администратор',
                'slug' => 'super-admin',
                'description' => 'Полный доступ ко всей CRM-системе.',
            ],[
                'name' => 'Менеджер',
                'slug' => 'manager',
                'description' => 'Управляет клиентами, арендой и бронированиями.',
            ],[
                'name' => 'Бухгалтер',
                'slug' => 'accountant',
                'description' => 'Управляет платежами, счетами и финансовыми данными.',
            ],[
                'name' => 'Руководитель автопарка',
                'slug' => 'fleet-manager',
                'description' => 'Управляет транспортными средствами, их техническим обслуживанием и эксплуатацией автопарка.',
            ],
        ];
        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['slug' => $role['slug']],
                $role
            );
        }
    }
}
