<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
            VehicleCategorySeeder::class,
            VehicleSeeder::class,
            MaintenanceTypeSeeder::class,
            MaintenanceSeeder::class,
            VehicleExpenseSeeder::class,
            CustomerSeeder::class,
            CustomerDocumentSeeder::class,
            RentalSeeder::class,
            ContractInvoicePaymentSeeder::class,
        ]);
    }
}
