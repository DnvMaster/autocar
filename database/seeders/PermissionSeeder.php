<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'Открыть панель управления', 'slug' => 'dashboard.view'],
            ['name' => 'Просмотр клиентов', 'slug' => 'customers.view'],
            ['name' => 'Создать клиентов', 'slug' => 'customers.create'],
            ['name' => 'Редактировать клиентов', 'slug' => 'customers.edit'],
            ['name' => 'Удалить клиентов', 'slug' => 'customers.delete'],
            ['name' => 'Посмотреть автомобили', 'slug' => 'vehicles.view'],
            ['name' => 'Создать транспортные средства', 'slug' => 'vehicles.create'],
            ['name' => 'Редактировать транспортные средства', 'slug' => 'vehicles.edit'],
            ['name' => 'Удалить транспортные средства', 'slug' => 'vehicles.delete'],
            ['name' => 'Посмотреть варианты аренды', 'slug' => 'rentals.view'],
            ['name' => 'Создать аренду', 'slug' => 'rentals.create'],
            ['name' => 'Редактировать аренду', 'slug' => 'rentals.edit'],
            ['name' => 'Отменить аренду', 'slug' => 'rentals.cancel'],
            ['name' => 'Просмотр платежей', 'slug' => 'payments.view'],
            ['name' => 'Создать платежи', 'slug' => 'payments.create'],
            ['name' => 'Просмотр счетов', 'slug' => 'invoices.view'],
            ['name' => 'Создать счета', 'slug' => 'invoices.create'],
            ['name' => 'Посмотреть техническое обслуживание', 'slug' => 'maintenance.view'],
            ['name' => 'Создать задачу по техобслуживанию', 'slug' => 'maintenance.create'],
            ['name' => 'Редактирование параметров обслуживания', 'slug' => 'maintenance.edit'],
            ['name' => 'Просмотр отчетов', 'slug' => 'reports.view'],
            ['name' => 'Просмотр пользователей', 'slug' => 'users.view'],
            ['name' => 'Создать пользователей', 'slug' => 'users.create'],
            ['name' => 'Редактировать пользователей', 'slug' => 'users.edit'],
            ['name' => 'Удалить пользователей', 'slug' => 'users.delete'],
            ['name' => 'Настройки вида', 'slug' => 'settings.view'],
            ['name' => 'Изменить настройки', 'slug' => 'settings.edit'],
        ];
        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['slug' => $permission['slug']],
                $permission
            );
        }
    }
}
