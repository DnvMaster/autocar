@extends('layouts.app')
@section('title', __('ui.navigation.dashboard'))
@section('page-title', __('ui.navigation.dashboard'))
@section('content')

    @push('styles')
            @vite('resources/css/dashboard.css')
    @endpush

    @push('scripts')
        @vite('resources/js/dashboard.js')
    @endpush
    <div class="space-y-6">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">  {{ __('ui.dashboard.title') }}</h2>
                <p class="text-gray-500 mt-1">{{ __('ui.dashboard.description') }}</p>
            </div>
            <a href="#" class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-blue-700 transition"><span>+</span>{{ __('ui.dashboard.new_rental') }}</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-2xl border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">{{ __('ui.dashboard.total_revenue') }}</p>
                        <h3 class="mt-2 text-3xl font-bold text-gray-900">{{ number_format($stats['revenue'], 2, ',', ' ') }} €</h3>
                    </div>
                <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center text-xl">💰</div>
            </div>
            <div class="mt-4 flex items-center gap-2 text-sm">
                @if($stats['revenue_growth'] > 0)
                    <span class="font-semibold text-green-600">↑ {{ number_format($stats['revenue_growth'], 1, ',', ' ') }}%</span>
                @elseif($stats['revenue_growth'] < 0)
                    <span class="font-semibold text-red-600">↓ {{ number_format(abs($stats['revenue_growth']), 1, ',', ' ') }}%</span>
                @else
                    <span class="font-semibold text-gray-500">0%</span>
                @endif
                <span class="text-gray-500">{{ __('ui.dashboard.growth') }}</span>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">{{ __('ui.dashboard.active_rentals') }}</p>
                    <h3 class="mt-2 text-3xl font-bold text-gray-900">{{ $stats['active_rentals'] }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-xl">🚗</div>
            </div>
            <div class="mt-4 flex items-center gap-2 text-sm">
                @if($stats['active_rentals_growth'] > 0)
                    <span class="font-semibold text-green-600">↑ {{ number_format($stats['active_rentals_growth'], 1, ',', ' ') }}%</span>
                @elseif($stats['active_rentals_growth'] < 0)
                    <span class="font-semibold text-red-600">↓ {{ number_format(abs($stats['active_rentals_growth']), 1, ',', ' ') }}%</span>
                @else
                    <span class="font-semibold text-gray-500">0%</span>
                @endif
                    <span class="text-gray-500">{{ __('ui.dashboard.from_last_month') }}</span>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">{{ __('ui.dashboard.fleet_vehicles') }}</p>
                    <h3 class="text-3xl font-bold text-gray-900">{{ $stats['vehicles'] }}</h3>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center text-xl">🚘</div>
                </div>
                <div class="mt-4">
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-500">{{ __('ui.dashboard.fleet_utilization') }}</span>
                        <span class="font-semibold">{{ $stats['fleet_utilization'] }}%</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-2">
                        <div class="bg-purple-600 h-2 rounded-full" style="width: {{ $stats['fleet_utilization'] }}%"></div>
                    </div>
                </div>
               <div class="mt-4 grid grid-cols-2 gap-3 text-xs">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-green-500"></span>
                        <span class="text-gray-500">
                            {{ $stats['available_vehicles'] }} доступно
                        </span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
                        <span class="text-gray-500">
                            {{ $stats['reserved_vehicles'] }} забронировано
                        </span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                        <span class="text-gray-500">
                            {{ $stats['rented_vehicles'] }} в аренде
                        </span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-red-500"></span>
                        <span class="text-gray-500">
                            {{ $stats['maintenance_vehicles'] }} обслуживание
                        </span>
                    </div>
                </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">{{ __('ui.dashboard.outstanding') }}</p>
                    <h3 class="mt-2 text-3xl font-bold text-gray-900">{{ number_format($stats['outstanding'],2,',',' ') }} €</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center text-xl">⚠️</div>
            </div>
            <div class="mt-4 flex items-center gap-2 text-sm">
                @if($stats['outstanding_growth'] > 0)
                    <span class="font-semibold text-red-600">↑ {{ number_format($stats['outstanding_growth'], 1, ',', ' ') }}%</span>
                @elseif($stats['outstanding_growth'] < 0)
                    <span class="font-semibold text-green-600">↓ {{ number_format(abs($stats['outstanding_growth']), 1, ',', ' ') }}%</span>
                @else
                    <span class="font-semibold text-gray-500">0%</span>
                @endif
                <span class="text-gray-500">{{ __('ui.dashboard.from_last_month') }}</span>
            </div>
        </div>
    </div>



    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-8">
        <div class="xl:col-span-2 bg-white rounded-2xl border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Выручка</h3>
                    <p class="text-sm text-gray-500 mt-1">Выручка по месяцам за {{ now()->year }} год</p>
                </div>
            </div>
           <div class="dashboard-chart">
    <canvas
        id="revenueChart"
        data-revenue='@json($revenueMonths)'
    ></canvas>
</div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 p-6">
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Состояние автопарка</h3>
                <p class="text-sm text-gray-500 mt-1">Текущее распределение автомобилей</p>
            </div>

            <div class="space-y-5">
                <div>
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-600">Доступны</span>
                        <span class="font-semibold">{{ $stats['available_vehicles'] }}</span>
                    </div>
                    <div class="h-2 bg-gray-100 rounded-full">
                        <div class="h-2 rounded-full bg-green-500" style="width: {{ $stats['vehicles'] > 0 ? ($stats['available_vehicles'] / $stats['vehicles']) * 100 : 0 }}%"></div>
                    </div>
                </div>
            </div>

            <div class="flex justify-between text-sm mb-2">
                <span class="text-gray-600">Забронированы</span>
                <span class="font-semibold">{{ $stats['reserved_vehicles'] }}</span>
            </div>

            <div class="h-2 bg-gray-100 rounded-full">
                <div class="h-2 rounded-full bg-yellow-500" style="width: {{ $stats['vehicles'] > 0 ? ($stats['reserved_vehicles'] / $stats['vehicles']) * 100 : 0 }}%"></div>
            </div>

            <div class="flex justify-between text-sm mb-2">
                <span class="text-gray-600">В аренде</span>
                <span class="font-semibold">{{ $stats['rented_vehicles'] }}</span>
            </div>

            <div class="h-2 bg-gray-100 rounded-full">
                <div class="h-2 rounded-full bg-blue-500" style="width: {{ $stats['vehicles'] > 0 ? ($stats['rented_vehicles'] / $stats['vehicles']) * 100 : 0 }}%"></div>
            </div>

            <div class="flex justify-between text-sm mb-2">
                <span class="text-gray-600">На обслуживании</span>
                <span class="font-semibold">{{ $stats['maintenance_vehicles'] }}</span>
            </div>

            <div class="h-2 bg-gray-100 rounded-full">
                <div class="h-2 rounded-full bg-red-500" style="width: {{ $stats['vehicles'] > 0 ? ($stats['maintenance_vehicles'] / $stats['vehicles']) * 100 : 0 }}%"></div>
            </div>
        </div>


    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <div class="xl:col-span-2 bg-white rounded-xl border border-gray-200">
            <div class="p-5 border-b border-gray-200 flex items-center justify-between">
                <div>
                    <h3 class="font-semibold text-gray-900">{{ __('ui.dashboard.recent_rentals') }}</h3>
                    <p class="text-sm text-gray-500 mt-1">{{ __('ui.dashboard.latest_rental_activity') }}</p>
                </div>
                <a href="#" class="text-sm text-blue-600 hover:text-blue-700">{{ __('ui.dashboard.view_all') }}</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-5 py-3 text-left font-medium text-gray-500">{{ __('ui.dashboard.customer') }}</th>
                            <th class="px-5 py-3 text-left font-medium text-gray-500">{{ __('ui.dashboard.vehicle') }}</th>
                            <th class="px-5 py-3 text-left font-medium text-gray-500">{{ __('ui.dashboard.total') }}</th>
                            <th class="px-5 py-3 text-left font-medium text-gray-500">{{ __('ui.dashboard.status') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($recentRentals ?? [] as $rental)
                            <tr class="hover:bg-gray-50">
                                <td class="px-5 py-4">
                                    <div class="font-medium text-gray-900">{{ $rental->customer->company_name ?? $rental->customer->first_name . ' ' . $rental->customer->last_name }}</div>
                                </td>
                                <td class="px-5 py-4 text-gray-600">
                                    {{ $rental->vehicle->brand ?? '' }}
                                    {{ $rental->vehicle->model ?? '' }}
                                </td>
                                <td class="px-5 py-4 font-medium">€{{ number_format($rental->total, 2, ',', '.') }}</td>
                                <td class="px-5 py-4">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                        {{ __('ui.rental_status.' . $rental->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-5 py-10 text-center text-gray-500">{{ __('ui.dashboard.no_rentals') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-gray-200">
            <div class="p-5 border-b border-gray-200">
                <h3 class="font-semibold">{{ __('ui.dashboard.invoice_overview') }}</h3>
                <p class="text-sm text-gray-500 mt-1">{{ __('ui.dashboard.current_invoice_status') }}</p>
            </div>
            <div class="p-5 space-y-5">
                @foreach($invoiceStats ?? [] as $invoice)
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-sm text-gray-600">{{ __('ui.invoice_status.'. $invoice->status) }}</span>
                            <span class="text-sm font-semibold">{{ $invoice->total }}</span>
                        </div>
                        <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-blue-600 rounded-full" style="width: {{ $invoice->percentage ?? 0 }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
