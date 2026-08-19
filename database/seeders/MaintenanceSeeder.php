<?php

namespace Database\Seeders;

use App\Models\Maintenance;
use App\Models\MaintenanceType;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class MaintenanceSeeder extends Seeder
{
    public function run(): void
    {
        $vehicles = Vehicle::all();
        if($vehicles->isEmpty()) {
            return;
        }
        $types = MaintenanceType::pluck('id', 'slug');
        $records = [
            [
                'vehicle' => 'F-AC 101',
                'type' => 'oil-change',
                'title' => 'Engine oil service',
                'description' => 'Oil and oil filter replacement.',
                'mileage' => 25000,
                'cost' => 145.00,
                'performed_at' => '2026-01-15',
                'next_service_at' => '2026-07-15',
                'status' => 'completed',
            ],[
                'vehicle' => 'F-AC 102',
                'type' => 'brake-service',
                'title' => 'Front brake replacement',
                'description' => 'Front brake pads and discs replaced.',
                'mileage' => 14000,
                'cost' => 420.00,
                'performed_at' => '2026-02-03',
                'next_service_at' => '2027-02-03',
                'status' => 'completed',
            ],[
                'vehicle' => 'F-AC 103',
                'type' => 'inspection',
                'title' => 'Annual technical inspection',
                'description' => 'Vehicle passed technical inspection.',
                'mileage' => 30000,
                'cost' => 120.00,
                'performed_at' => '2026-02-18',
                'next_service_at' => '2027-02-18',
                'status' => 'completed',
            ],[
                'vehicle' => 'F-AC 104',
                'type' => 'tire-service',
                'title' => 'Summer tire installation',
                'description' => 'Seasonal tire replacement and balancing.',
                'mileage' => 11000,
                'cost' => 180.00,
                'performed_at' => '2026-03-20',
                'next_service_at' => '2026-10-20',
                'status' => 'completed',
            ],[
                'vehicle' => 'F-AC 105',
                'type' => 'oil-change',
                'title' => 'Scheduled oil service',
                'description' => 'Engine oil and filter replacement.',
                'mileage' => 21000,
                'cost' => 155.00,
                'performed_at' => '2026-03-28',
                'next_service_at' => '2026-09-28',
                'status' => 'completed',
            ],[
                'vehicle' => 'F-AC 106',
                'type' => 'major-service',
                'title' => 'Scheduled major service',
                'description' => 'Full scheduled maintenance.',
                'mileage' => 9000,
                'cost' => 560.00,
                'performed_at' => '2026-04-04',
                'next_service_at' => '2027-04-04',
                'status' => 'completed',
            ],[
                'vehicle' => 'F-AC 107',
                'type' => 'tire-service',
                'title' => 'Tire replacement',
                'description' => 'Four new summer tires installed.',
                'mileage' => 17500,
                'cost' => 640.00,
                'performed_at' => '2026-04-12',
                'next_service_at' => '2027-04-12',
                'status' => 'completed',
            ],[
                'vehicle' => 'F-AC 108',
                'type' => 'inspection',
                'title' => 'Technical inspection',
                'description' => 'Regular fleet inspection.',
                'mileage' => 13800,
                'cost' => 130.00,
                'performed_at' => '2026-04-25',
                'next_service_at' => '2027-04-25',
                'status' => 'completed',
            ],[
                'vehicle' => 'F-AC 109',
                'type' => 'oil-change',
                'title' => 'Engine oil service',
                'description' => 'Oil and filter replacement.',
                'mileage' => 25000,
                'cost' => 150.00,
                'performed_at' => '2026-05-02',
                'next_service_at' => '2026-11-02',
                'status' => 'completed',
            ],[
                'vehicle' => 'F-AC 110',
                'type' => 'repair',
                'title' => 'Cooling system repair',
                'description' => 'Cooling system inspection and repair.',
                'mileage' => 10800,
                'cost' => 780.00,
                'performed_at' => '2026-05-11',
                'next_service_at' => '2027-05-11',
                'status' => 'completed',
            ],[
                'vehicle' => 'F-AC 111',
                'type' => 'oil-change',
                'title' => 'Scheduled service',
                'description' => 'Engine oil and filter replacement.',
                'mileage' => 8500,
                'cost' => 170.00,
                'performed_at' => '2026-05-18',
                'next_service_at' => '2026-11-18',
                'status' => 'completed',
            ],[
                'vehicle' => 'F-AC 112',
                'type' => 'brake-service',
                'title' => 'Brake inspection',
                'description' => 'Brake system inspection and service.',
                'mileage' => 7200,
                'cost' => 290.00,
                'performed_at' => '2026-05-25',
                'next_service_at' => '2027-05-25',
                'status' => 'completed',
            ],[
                'vehicle' => 'F-AC 113',
                'type' => 'inspection',
                'title' => 'Technical inspection',
                'description' => 'Annual vehicle inspection.',
                'mileage' => 19000,
                'cost' => 125.00,
                'performed_at' => '2026-06-01',
                'next_service_at' => '2027-06-01',
                'status' => 'completed',
            ],[
                'vehicle' => 'F-AC 114',
                'type' => 'tire-service',
                'title' => 'Wheel balancing',
                'description' => 'Wheel balancing and tire pressure check.',
                'mileage' => 13000,
                'cost' => 95.00,
                'performed_at' => '2026-06-08',
                'next_service_at' => '2026-12-08',
                'status' => 'completed',
            ],[
                'vehicle' => 'F-AC 115',
                'type' => 'major-service',
                'title' => 'Scheduled maintenance',
                'description' => 'Major scheduled service.',
                'mileage' => 16000,
                'cost' => 690.00,
                'performed_at' => '2026-06-15',
                'next_service_at' => '2027-06-15',
                'status' => 'completed',
            ],[
                'vehicle' => 'F-AC 116',
                'type' => 'battery',
                'title' => 'Hybrid battery inspection',
                'description' => 'Hybrid battery diagnostic and inspection.',
                'mileage' => 9800,
                'cost' => 210.00,
                'performed_at' => '2026-06-20',
                'next_service_at' => '2027-06-20',
                'status' => 'completed',
            ],[
                'vehicle' => 'F-AC 117',
                'type' => 'oil-change',
                'title' => 'Engine oil service',
                'description' => 'Oil and filter replacement.',
                'mileage' => 22500,
                'cost' => 155.00,
                'performed_at' => '2026-06-27',
                'next_service_at' => '2026-12-27',
                'status' => 'completed',
            ],[
                'vehicle' => 'F-AC 118',
                'type' => 'inspection',
                'title' => 'Fleet inspection',
                'description' => 'Full vehicle inspection.',
                'mileage' => 8000,
                'cost' => 145.00,
                'performed_at' => '2026-07-02',
                'next_service_at' => '2027-07-02',
                'status' => 'completed',
            ],[
                'vehicle' => 'F-AC 119',
                'type' => 'oil-change',
                'title' => 'Scheduled oil service',
                'description' => 'Engine oil replacement.',
                'mileage' => 6500,
                'cost' => 165.00,
                'performed_at' => '2026-07-08',
                'next_service_at' => '2027-01-08',
                'status' => 'completed',
            ],[
                'vehicle' => 'F-AC 120',
                'type' => 'tire-service',
                'title' => 'Tire inspection',
                'description' => 'Tire condition and pressure inspection.',
                'mileage' => 15000,
                'cost' => 90.00,
                'performed_at' => '2026-07-12',
                'next_service_at' => '2026-10-12',
                'status' => 'completed',
            ],[
                'vehicle' => 'F-AC 121',
                'type' => 'inspection',
                'title' => 'Luxury vehicle inspection',
                'description' => 'Full technical inspection.',
                'mileage' => 4000,
                'cost' => 180.00,
                'performed_at' => '2026-07-15',
                'next_service_at' => '2027-07-15',
                'status' => 'completed',
            ],[
                'vehicle' => 'F-AC 122',
                'type' => 'battery',
                'title' => 'Battery diagnostic',
                'description' => 'Battery health check.',
                'mileage' => 3500,
                'cost' => 110.00,
                'performed_at' => '2026-07-18',
                'next_service_at' => '2027-07-18',
                'status' => 'completed',
            ],[
                'vehicle' => 'F-AC 123',
                'type' => 'major-service',
                'title' => 'Major scheduled service',
                'description' => 'Full scheduled maintenance.',
                'mileage' => 9000,
                'cost' => 850.00,
                'performed_at' => '2026-07-22',
                'next_service_at' => '2027-07-22',
                'status' => 'completed',
            ],[
                'vehicle' => 'F-AC 124',
                'type' => 'inspection',
                'title' => 'Electric vehicle inspection',
                'description' => 'Electric drivetrain and battery inspection.',
                'mileage' => 6000,
                'cost' => 160.00,
                'performed_at' => '2026-07-25',
                'next_service_at' => '2027-07-25',
                'status' => 'completed',
            ],[
                'vehicle' => 'F-AC 125',
                'type' => 'tire-service',
                'title' => 'Tire service',
                'description' => 'Seasonal tire service.',
                'mileage' => 7500,
                'cost' => 190.00,
                'performed_at' => '2026-07-28',
                'next_service_at' => '2026-10-28',
                'status' => 'completed',
            ],
        ];
        foreach ($records as $record) {
            $vehicle = Vehicle::where('license_plate', $record['vehicle'])->first();
            if(!$vehicle) {
                continue;
            }

            Maintenance::updateOrCreate(
                ['vehicle_id' => $vehicle->id,'title' => $record['title']],
                [
                    'type_id' => $types[$record['type']],
                    'description' => $record['description'],
                    'mileage' => $record['mileage'],
                    'cost' => $record['cost'],
                    'performed_at' => $record['performed_at'],
                    'next_service_at' => $record['next_service_at'],
                    'status' => $record['status'],
                ]
            );
        }
    }
}
