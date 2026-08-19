@extends('layouts.app')
@section('title', 'Автомобили')
@push('styles')
    @vite('resources/css/vehicles.css')
@endpush
@push('scripts')
    @vite('resources/js/vehicles.js')
@endpush
@section('content')
    <div class="vehicles-page max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between mb-8">
            <div>
            <h1 class="text-2xl font-semibold text-gray-900">Автомобили</h1>
            <p class="mt-1 text-sm text-gray-500">Управление автопарком и доступностью автомобилей</p>
        </div>
        <a href="#" class="inline-flex items-center justify-center rounded-lg bg-gray-900 px-4 py-2.5 text-sm font-medium text-white hover:bg-gray-800 transition"> + Добавить автомобиль</a>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white border border-gray-200 rounded-xl p-5">
            <p class="text-sm text-gray-500">Всего автомобилей</p>
            <p class="mt-2 text-2xl font-semibold text-gray-900">{{ $vehicleStats['total'] }}</p>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl p-5">
            <p class="text-sm text-gray-500">Доступны</p>
            <p class="mt-2 text-2xl font-semibold text-green-600">{{ $vehicleStats['available'] }}</p>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl p-5">
            <p class="text-sm text-gray-500">Забронированы</p>
            <p class="mt-2 text-2xl font-semibold text-yellow-600">{{ $vehicleStats['reserved'] }}</p>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl p-5">
            <p class="text-sm text-gray-500">В аренде</p>
            <p class="mt-2 text-2xl font-semibold text-blue-600">{{ $vehicleStats['rented'] }}</p>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-xl p-5 mb-6">
        <form method="GET" action="{{ route('vehicles.index') }}" data-vehicles-filter-form class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="lg:col-span-2">
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Поиск</label>
                <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Марка, модель, госномер или VIN..." class="w-full rounded-lg border-gray-300 focus:border-gray-500 focus:ring-gray-500">
            </div>
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Статус</label>
                <select id="status" name="status" class="w-full rounded-lg border-gray-300 focus:border-gray-500 focus:ring-gray-500">
                    <option value="">Все статусы</option>
                    <option value="available" @selected(request('status') === 'available')>Доступен</option>
                    <option value="reserved" @selected(request('status') === 'reserved')>Забронирован</option>
                    <option value="rented" @selected(request('status') === 'rented')>В аренде</option>
                    <option value="maintenance" @selected(request('status') === 'maintenance')>На обслуживании</option>
                </select>
            </div>
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Категория</label>
                <select id="category" name="category" class="w-full rounded-lg border-gray-300 focus:border-gray-500 focus:ring-gray-500">
                    <option value="">Все категории</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected((string) request('category') === (string) $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="brand" class="block text-sm font-medium text-gray-700 mb-1">Марка</label>
                <select id="brand" name="brand" class="w-full rounded-lg border-gray-300 focus:border-gray-500 focus:ring-gray-500">
                    <option value="">Все марки</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand }}" @selected(request('brand') === $brand)>{{ $brand }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="flex-1 rounded-lg bg-gray-900 px-4 py-2.5 text-sm font-medium text-white hover:bg-gray-800 transition">Найти</button>
                <a href="{{ route('vehicles.index') }}" class="rounded-lg border border-gray-300 px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">Сбросить</a>
            </div>
        </form>
    </div>
    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Автомобиль</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Гос. номер</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Категория</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Год</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Цена / день</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Статус</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Действия</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($vehicles as $vehicle)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <a href="{{ route('vehicles.show', $vehicle) }}" class="font-medium text-gray-900 hover:text-gray-600">{{ $vehicle->brand }} {{ $vehicle->model }}</a>
                                <p class="text-sm text-gray-500 mt-0.5">{{ $vehicle->color }}
                                    @if($vehicle->transmission) ·
                                        {{ ucfirst($vehicle->transmission) }}
                                    @endif
                                </p>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $vehicle->license_plate }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $vehicle->category?->name ?? '—' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $vehicle->year }}</td>
                            <td class="px-6 py-4">
                                <span class="font-medium text-gray-900">{{ number_format($vehicle->daily_rate, 2, ',', ' ') }} €</span>
                                <span class="text-xs text-gray-500"> / день</span>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $statusClasses = match($vehicle->status) {
                                        'available' => 'bg-green-100 text-green-700',
                                        'reserved' => 'bg-yellow-100 text-yellow-700',
                                        'rented' => 'bg-blue-100 text-blue-700',
                                        'maintenance' => 'bg-red-100 text-red-700',
                                        default => 'bg-gray-100 text-gray-700',
                                    };
                                    $statusLabels = [
                                        'available' => 'Доступен',
                                        'reserved' => 'Забронирован',
                                        'rented' => 'В аренде',
                                        'maintenance' => 'Обслуживание',
                                    ];
                                @endphp
                                <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-medium {{ $statusClasses }}">{{ $statusLabels[$vehicle->status] ?? $vehicle->status }}</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('vehicles.show', $vehicle) }}" class="text-sm font-medium text-gray-700 hover:text-gray-900">Подробнее</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <p class="text-sm font-medium text-gray-900">Автомобили не найдены</p>
                                <p class="mt-1 text-sm text-gray-500">Измените параметры поиска или фильтрации.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($vehicles->hasPages())
            <div class="border-t border-gray-200 px-6 py-4">{{ $vehicles->links() }}</div>
        @endif
    </div>
</div>
@endsection
