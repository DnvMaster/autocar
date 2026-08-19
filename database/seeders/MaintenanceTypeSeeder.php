<?php

namespace Database\Seeders;

use App\Models\MaintenanceType;
use Illuminate\Database\Seeder;

class MaintenanceTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            [
                'name' => 'Oil Change',
                'slug' => 'oil-change',
                'description' => 'Engine oil and oil filter replacement.',
            ],[
                'name' => 'Brake Service',
                'slug' => 'brake-service',
                'description' => 'Brake pads, discs and brake system maintenance.',
            ],[
                'name' => 'Tire Service',
                'slug' => 'tire-service',
                'description' => 'Tire replacement, balancing and seasonal service.',
            ],[
                'name' => 'Inspection',
                'slug' => 'inspection',
                'description' => 'Regular technical inspection.',
            ],[
                'name' => 'Major Service',
                'slug' => 'major-service',
                'description' => 'Scheduled major vehicle maintenance.',
            ],[
                'name' => 'Battery',
                'slug' => 'battery',
                'description' => 'Battery inspection or replacement.',
            ],[
                'name' => 'Repair',
                'slug' => 'repair',
                'description' => 'General vehicle repair.',
            ],
        ];
        foreach ($types as $type) {
            MaintenanceType::updateOrCreate(
                ['slug' => $type['slug']],
                $type
            );
        }
    }
}
