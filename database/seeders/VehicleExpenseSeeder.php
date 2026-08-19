<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use App\Models\VehicleExpense;
use Illuminate\Database\Seeder;

class VehicleExpenseSeeder extends Seeder
{
    public function run(): void
    {
        $expenses = [
            ['F-AC 101', 'Insurance', 'Annual vehicle insurance', 680.00, '2026-01-05'],
            ['F-AC 102', 'Insurance', 'Annual vehicle insurance', 720.00, '2026-01-06'],
            ['F-AC 103', 'Cleaning', 'Professional interior cleaning', 85.00, '2026-02-10'],
            ['F-AC 104', 'Cleaning', 'Deep vehicle cleaning', 110.00, '2026-02-15'],
            ['F-AC 105', 'Insurance', 'Annual vehicle insurance', 890.00, '2026-01-10'],
            ['F-AC 106', 'Fuel', 'Fuel expenses', 420.00, '2026-03-01'],
            ['F-AC 107', 'Insurance', 'Annual vehicle insurance', 980.00, '2026-01-12'],
            ['F-AC 108', 'Cleaning', 'Fleet cleaning service', 120.00, '2026-03-15'],
            ['F-AC 109', 'Fuel', 'Fuel expenses', 510.00, '2026-04-01'],
            ['F-AC 110', 'Repair', 'Cooling system repair', 780.00, '2026-05-11'],
            ['F-AC 111', 'Insurance', 'Annual vehicle insurance', 1050.00, '2026-01-20'],
            ['F-AC 112', 'Cleaning', 'Interior cleaning', 95.00, '2026-04-20'],
            ['F-AC 113', 'Fuel', 'Fuel expenses', 390.00, '2026-05-01'],
            ['F-AC 114', 'Cleaning', 'Exterior detailing', 130.00, '2026-05-10'],
            ['F-AC 115', 'Insurance', 'Annual vehicle insurance', 1150.00, '2026-01-22'],
            ['F-AC 116', 'Fuel', 'Fuel expenses', 280.00, '2026-06-01'],
            ['F-AC 117', 'Insurance', 'Annual vehicle insurance', 920.00, '2026-01-25'],
            ['F-AC 118', 'Cleaning', 'Premium detailing', 160.00, '2026-06-10'],
            ['F-AC 119', 'Fuel', 'Fuel expenses', 310.00, '2026-06-15'],
            ['F-AC 120', 'Cleaning', 'Fleet cleaning service', 100.00, '2026-06-20'],
            ['F-AC 121', 'Insurance', 'Luxury vehicle insurance', 1650.00, '2026-01-28'],
            ['F-AC 122', 'Charging', 'Public charging expenses', 180.00, '2026-07-01'],
            ['F-AC 123', 'Repair', 'Suspension repair', 950.00, '2026-07-05'],
            ['F-AC 124', 'Charging', 'Electric charging expenses', 210.00, '2026-07-10'],
            ['F-AC 125', 'Cleaning', 'Premium detailing', 180.00, '2026-07-15'],
        ];

        foreach ($expenses as $expense) {
            $vehicle = Vehicle::where(
                'license_plate',
                $expense[0]
            )->first();
            if(!$vehicle) {
                continue;
            }
            VehicleExpense::updateOrCreate(
                [
                    'vehicle_id' => $vehicle->id,
                    'title' => $expense[1],
                    'expense_date' => $expense[4],
                ],
                [
                    'description' => $expense[2],
                    'amount' => $expense[3],
                    'category' => $expense[1],
                ]
            );
        }
    }
}
