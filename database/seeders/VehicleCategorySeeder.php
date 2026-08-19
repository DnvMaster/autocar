<?php

namespace Database\Seeders;

use App\Models\VehicleCategory;
use Illuminate\Database\Seeder;

class VehicleCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Экономный',
                'slug' => 'economy',
                'description' => 'Доступные и экономичные автомобили для повседневной аренды.',
                'default_daily_rate' => 39.00,
            ],[
                'name' => 'Компактный',
                'slug' => 'compact',
                'description' => 'Компактные автомобили, подходящие для езды по городу.',
                'default_daily_rate' => 49.00,
            ],[
                'name' => 'Бизнес',
                'slug' => 'business',
                'description' => 'Комфортабельные автомобили бизнес-класса для корпоративных клиентов.',
                'default_daily_rate' => 89.00,
            ],[
                'name' => 'Эксклюзивный',
                'slug' => 'executive',
                'description' => 'Автомобили премиум-класса для клиентов уровня «руководитель» и VIP-клиентов.',
                'default_daily_rate' => 149.00,
            ],[
                'name' => 'Внедорожник',
                'slug' => 'suv',
                'description' => 'Просторные внедорожники для семей и дальних поездок.',
                'default_daily_rate' => 109.00,
            ],[
                'name' => 'Премиум внедорожник',
                'slug' => 'premium-suv',
                'description' => 'Внедорожники премиум-класса с повышенным уровнем комфорта и расширенным оснащением.',
                'default_daily_rate' => 169.00,
            ],[
                'name' => 'Роскошный',
                'slug' => 'luxury',
                'description' => 'Роскошные автомобили для аренды премиум- и VIP-класса.',
                'default_daily_rate' => 249.00,
            ],[
                'name' => 'Электромобиль',
                'slug' => 'electric',
                'description' => 'Современные электромобили для устойчивой мобильности.',
                'default_daily_rate' => 119.00,
            ],
        ];
        foreach ($categories as $category) {
            VehicleCategory::updateOrCreate(
                ['slug' => $category['slug']],
                [
                    'name' => $category['name'],
                    'description' => $category['description'],
                    'default_daily_rate' => $category['default_daily_rate'],
                    'is_active' => true,
                ]
            );
        }
    }
}
