@extends('layouts.app')
@section('title', __('ui.navigation.dashboard'))
@section('page-title', __('ui.navigation.dashboard'))
@section('content')
    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">  {{ __('ui.dashboard.title') }}</h2>
                <p class="text-gray-500 mt-1">{{ __('ui.dashboard.description') }}</p>
            </div>
                <a href="#" class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-blue-700 transition"><span>+</span>{{ __('ui.dashboard.new_rental') }}</a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">
                <div class="bg-white rounded-xl border border-gray-200 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">{{ __('ui.dashboard.total_revenue') }}</p>
                    <p class="text-2xl font-bold mt-2">€{{ number_format($stats['revenue'] ?? 0, 2, ',', '.') }}</p>
                </div>
                <div class="w-11 h-11 rounded-lg bg-green-50 text-green-600 flex items-center justify-center">€</div>
            </div>
            <p class="text-xs text-green-600 mt-4">↑ 12.5% from last month</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">{{ __('ui.dashboard.active_rentals') }}</p>
                    <p class="text-2xl font-bold mt-2">{{ $stats['active_rentals'] ?? 0 }}</p>
                </div>
                <div class="w-11 h-11 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">🚗</div>
            </div>
            <p class="text-xs text-gray-500 mt-4">{{ __('ui.dashboard.currently_on_rental') }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">{{ __('ui.dashboard.fleet_vehicles') }}</p>
                    <p class="text-2xl font-bold mt-2">{{ $stats['vehicles'] ?? 0 }}</p>
                </div>
                <div class="w-11 h-11 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center">🚘</div>
            </div>
            <p class="text-xs text-gray-500 mt-4">{{ __('ui.dashboard.total_vehicles') }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">{{ __('ui.dashboard.outstanding') }}</p>
                    <p class="text-2xl font-bold mt-2">€ &nbsp;{{ number_format($stats['outstanding'] ?? 0, 2, ',', '.') }}</p>
                </div>
                <div class="w-11 h-11 rounded-lg bg-orange-50 text-orange-600 flex items-center justify-center">!</div>
            </div>
            <p class="text-xs text-orange-600 mt-4">{{ __('ui.dashboard.pending_payments') }}</p>
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
