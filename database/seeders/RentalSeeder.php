<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Rental;
use App\Models\RentalExtra;
use App\Models\RentalItem;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RentalSeeder extends Seeder
{
   public function run(): void
    {
        $customers = Customer::orderBy('id')->get();
        $vehicles = Vehicle::orderBy('id')->get();
        $users = User::orderBy('id')->get();
        if($customers->isEmpty() || $vehicles->isEmpty() || $users->isEmpty()) {
            return;
        }
        $rentalData = [
            ['2026-01-05', '2026-01-08', 'completed'],
            ['2026-01-12', '2026-01-16', 'completed'],
            ['2026-01-20', '2026-01-23', 'completed'],
            ['2026-02-02', '2026-02-07', 'completed'],
            ['2026-02-10', '2026-02-14', 'completed'],
            ['2026-02-18', '2026-02-22', 'completed'],
            ['2026-03-01', '2026-03-05', 'completed'],
            ['2026-03-08', '2026-03-12', 'completed'],
            ['2026-03-15', '2026-03-20', 'completed'],
            ['2026-03-25', '2026-03-29', 'completed'],
            ['2026-04-03', '2026-04-07', 'completed'],
            ['2026-04-10', '2026-04-15', 'completed'],
            ['2026-04-18', '2026-04-22', 'completed'],
            ['2026-04-25', '2026-04-29', 'completed'],
            ['2026-05-02', '2026-05-08', 'completed'],
            ['2026-05-10', '2026-05-14', 'completed'],
            ['2026-05-18', '2026-05-22', 'completed'],
            ['2026-05-25', '2026-05-30', 'completed'],
            ['2026-06-01', '2026-06-05', 'completed'],
            ['2026-06-08', '2026-06-13', 'completed'],
            ['2026-06-15', '2026-06-19', 'active'],
            ['2026-06-22', '2026-06-27', 'active'],
            ['2026-07-01', '2026-07-05', 'active'],
            ['2026-07-08', '2026-07-12', 'active'],
            ['2026-07-15', '2026-07-20', 'active'],
            ['2026-07-22', '2026-07-26', 'confirmed'],
            ['2026-07-25', '2026-07-30', 'confirmed'],
            ['2026-08-01', '2026-08-06', 'confirmed'],
            ['2026-08-08', '2026-08-12', 'confirmed'],
            ['2026-08-15', '2026-08-20', 'pending'],
        ];
        foreach ($rentalData as $index => $data) {
            $customer = $customers[$index % $customers->count()];
            $vehicle = $vehicles[$index % $vehicles->count()];
            $user = $users[$index % $users->count()];
            $startAt = Carbon::parse($data[0]);
            $endAt = Carbon::parse($data[1]);
            $days = $startAt->diffInDays($endAt);
            if ($days < 1) {
                $days = 1;
            }
            $dailyRate = match ($vehicle->category_id % 4) {
                0 => 95.00,
                1 => 120.00,
                2 => 165.00,
                default => 220.00,
            };
            $subtotal = $days * $dailyRate;
            $discount = $customer->type === 'company'
                ? round($subtotal * 0.10, 2)
                : 0;
            $deposit = match (true) {
                $dailyRate >= 200 => 1500.00,
                $dailyRate >= 150 => 1000.00,
                $dailyRate >= 100 => 750.00,
                default => 500.00,
            };
            $total = $subtotal - $discount;
            $rental = Rental::updateOrCreate(
                [
                    'customer_id' => $customer->id,
                    'vehicle_id' => $vehicle->id,
                    'start_at' => $startAt,
                ],[
                    'created_by' => $user->id,
                    'end_at' => $endAt,
                    'pickup_location' => $index % 3 === 0
                        ? 'Frankfurt Airport'
                        : 'AutoCar Frankfurt',
                    'return_location' => $index % 4 === 0
                        ? 'Frankfurt Airport'
                        : 'AutoCar Frankfurt',
                    'daily_rate' => $dailyRate,
                    'subtotal' => $subtotal,
                    'discount' => $discount,
                    'deposit' => $deposit,
                    'total' => $total,
                    'status' => $data[2],
                    'notes' => $customer->type === 'company'
                        ? 'Corporate rental agreement.'
                        : 'Private customer rental.',
                ]
            );
            $this->createRentalItems($rental, $days, $dailyRate);
            $this->createRentalExtras($rental, $index);
        }
    }
    private function createRentalItems(Rental $rental, int $days, float $dailyRate): void
    {
        RentalItem::updateOrCreate(
            [
                'rental_id' => $rental->id,
                'description' => 'Vehicle rental',
            ],[
                'quantity' => $days,
                'unit_price' => $dailyRate,
                'total' => $days * $dailyRate,
            ]
        );
    }
    private function createRentalExtras(Rental $rental, int $index): void
    {
        $extras = [
            [
                'name' => 'GPS Navigation',
                'quantity' => 1,
                'unit_price' => 12.00,
            ],[
                'name' => 'Additional Driver',
                'quantity' => 1,
                'unit_price' => 15.00,
            ],[
                'name' => 'Child Seat',
                'quantity' => 1,
                'unit_price' => 10.00,
            ],[
                'name' => 'Premium Insurance',
                'quantity' => 1,
                'unit_price' => 35.00,
            ],[
                'name' => 'Vehicle Delivery',
                'quantity' => 1,
                'unit_price' => 50.00,
            ],
        ];
        $extra = $extras[$index % count($extras)];
        RentalExtra::updateOrCreate(
            [
                'rental_id' => $rental->id,
                'name' => $extra['name'],
            ],[
                'quantity' => $extra['quantity'],
                'unit_price' => $extra['unit_price'],
                'total' => $extra['quantity'] * $extra['unit_price'],
            ]
        );
    }
}
