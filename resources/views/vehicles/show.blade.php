@extends('layouts.app')
@section('title', $vehicle->brand . ' ' . $vehicle->model)
@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
        <div>
            <a href="{{ route('vehicles.index') }}" class="text-sm text-gray-500 hover:text-gray-900"> ← Назад к автомобилям</a>
            <h1 class="mt-3 text-3xl font-semibold text-gray-900">{{ $vehicle->brand }} {{ $vehicle->model }}</h1>
            <p class="mt-1 text-gray-500">{{ $vehicle->license_plate }}</p>
        </div>
        <div>
            @php
                $status = [
                    'available' => [
                        'text' => 'Доступен',
                        'class' => 'bg-green-100 text-green-700'
                    ],
                    'reserved' => [
                        'text' => 'Забронирован',
                        'class' => 'bg-yellow-100 text-yellow-700'
                    ],
                    'rented' => [
                        'text' => 'В аренде',
                        'class' => 'bg-blue-100 text-blue-700'
                    ],
                    'maintenance' => [
                        'text' => 'Обслуживание',
                        'class' => 'bg-red-100 text-red-700'
                    ],
                ];
            @endphp
            <span class="inline-flex rounded-full px-4 py-2 text-sm font-medium {{ $status[$vehicle->status]['class'] ?? 'bg-gray-100 text-gray-700' }}">{{ $status[$vehicle->status]['text'] ?? $vehicle->status }}</span>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white border border-gray-200 rounded-xl p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-6">Основная информация</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                    <div>
                        <p class="text-sm text-gray-500">Марка</p>
                        <p class="mt-1 font-medium">{{ $vehicle->brand }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Модель</p>
                        <p class="mt-1 font-medium">{{ $vehicle->model }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Год</p>
                        <p class="mt-1 font-medium">{{ $vehicle->year }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Цвет</p>
                        <p class="mt-1 font-medium">{{ $vehicle->color ?? '—' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Коробка</p>
                        <p class="mt-1 font-medium">{{ ucfirst($vehicle->transmission) }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Топливо</p>
                        <p class="mt-1 font-medium">{{ ucfirst($vehicle->fuel_type) }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Мест</p>
                        <p class="mt-1 font-medium">{{ $vehicle->seats }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Пробег</p>
                        <p class="mt-1 font-medium">{{ number_format($vehicle->mileage, 0, ',', ' ') }} км</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">VIN</p>
                        <p class="mt-1 font-medium text-sm">{{ $vehicle->vin }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white border border-gray-200 rounded-xl p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Описание</h2>
                <p class="text-gray-600">{{ $vehicle->description ?? 'Описание отсутствует.' }}</p>
            </div>
            <div class="bg-white border border-gray-200 rounded-xl p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Обслуживание</h2>
                @forelse($vehicle->maintenance as $item)
                    <div class="border-b border-gray-100 py-3">
                        <div class="flex justify-between">
                            <span class="font-medium">{{ $item->maintenanceType?->name ?? 'ТО' }}</span>
                            <span class="text-gray-500 text-sm">{{ $item->date ?? '' }}</span>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-sm">Записей обслуживания нет.</p>
                @endforelse
            </div>
        </div>
        <div class="space-y-6">
            <div class="bg-white border border-gray-200 rounded-xl p-6">
                <h2 class="text-lg font-semibold mb-4">Аренда</h2>
                <p class="text-3xl font-semibold">{{ number_format($vehicle->daily_rate, 2, ',', ' ') }}€ </p>
                <p class="text-sm text-gray-500">за день</p>
            </div>
            <div class="bg-white border border-gray-200 rounded-xl p-6">
                <h2 class="text-lg font-semibold mb-4">Расходы</h2>
                <p class="text-2xl font-semibold">{{ number_format($vehicle->expenses->sum('amount'), 2, ',', ' ') }}€ </p>
                <p class="text-sm text-gray-500">всего расходов</p>
            </div>
        </div>
    </div>
</div>
@endsection
