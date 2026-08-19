@extends('layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('content')
    <div class="space-y-6">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Fleet Overview</h2>
                <p class="text-gray-500 mt-1">Overview of your rental business</p>
            </div>
                <a href="#" class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-blue-700 transition"><span>+</span>New Rental</a>
            </div>
            {{-- Statistics --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

        {{-- Revenue --}}
        <div class="bg-white rounded-xl border border-gray-200 p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Total Revenue
                    </p>

                    <p class="text-2xl font-bold mt-2">
                        €{{ number_format($stats['revenue'] ?? 0, 2, ',', '.') }}
                    </p>

                </div>

                <div class="w-11 h-11 rounded-lg bg-green-50 text-green-600 flex items-center justify-center">
                    €
                </div>

            </div>

            <p class="text-xs text-green-600 mt-4">
                ↑ 12.5% from last month
            </p>

        </div>


        {{-- Active Rentals --}}
        <div class="bg-white rounded-xl border border-gray-200 p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Active Rentals
                    </p>

                    <p class="text-2xl font-bold mt-2">
                        {{ $stats['active_rentals'] ?? 0 }}
                    </p>

                </div>

                <div class="w-11 h-11 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                    🚗
                </div>

            </div>

            <p class="text-xs text-gray-500 mt-4">
                Currently on rental
            </p>

        </div>


        {{-- Vehicles --}}
        <div class="bg-white rounded-xl border border-gray-200 p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Fleet Vehicles
                    </p>

                    <p class="text-2xl font-bold mt-2">
                        {{ $stats['vehicles'] ?? 0 }}
                    </p>

                </div>

                <div class="w-11 h-11 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center">
                    🚘
                </div>

            </div>

            <p class="text-xs text-gray-500 mt-4">
                Total vehicles
            </p>

        </div>


        {{-- Outstanding --}}
        <div class="bg-white rounded-xl border border-gray-200 p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Outstanding
                    </p>

                    <p class="text-2xl font-bold mt-2">
                        €{{ number_format($stats['outstanding'] ?? 0, 2, ',', '.') }}
                    </p>

                </div>

                <div class="w-11 h-11 rounded-lg bg-orange-50 text-orange-600 flex items-center justify-center">
                    !
                </div>

            </div>

            <p class="text-xs text-orange-600 mt-4">
                Pending payments
            </p>

        </div>

    </div>


    {{-- Content --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        {{-- Recent Rentals --}}
        <div class="xl:col-span-2 bg-white rounded-xl border border-gray-200">

            <div class="p-5 border-b border-gray-200 flex items-center justify-between">

                <div>

                    <h3 class="font-semibold text-gray-900">
                        Recent Rentals
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Latest rental activity
                    </p>

                </div>

                <a href="#" class="text-sm text-blue-600 hover:text-blue-700">
                    View all
                </a>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead class="bg-gray-50">

                        <tr>

                            <th class="px-5 py-3 text-left font-medium text-gray-500">
                                Customer
                            </th>

                            <th class="px-5 py-3 text-left font-medium text-gray-500">
                                Vehicle
                            </th>

                            <th class="px-5 py-3 text-left font-medium text-gray-500">
                                Total
                            </th>

                            <th class="px-5 py-3 text-left font-medium text-gray-500">
                                Status
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        @forelse($recentRentals ?? [] as $rental)

                            <tr class="hover:bg-gray-50">

                                <td class="px-5 py-4">

                                    <div class="font-medium text-gray-900">
                                        {{ $rental->customer->company_name
                                            ?? $rental->customer->first_name . ' ' . $rental->customer->last_name }}
                                    </div>

                                </td>

                                <td class="px-5 py-4 text-gray-600">
                                    {{ $rental->vehicle->brand ?? '' }}
                                    {{ $rental->vehicle->model ?? '' }}
                                </td>

                                <td class="px-5 py-4 font-medium">
                                    €{{ number_format($rental->total, 2, ',', '.') }}
                                </td>

                                <td class="px-5 py-4">

                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium
                                        bg-gray-100 text-gray-700">

                                        {{ ucfirst($rental->status) }}

                                    </span>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4" class="px-5 py-10 text-center text-gray-500">
                                    No rentals found
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- Invoice Status --}}
        <div class="bg-white rounded-xl border border-gray-200">

            <div class="p-5 border-b border-gray-200">

                <h3 class="font-semibold">
                    Invoice Overview
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    Current invoice status
                </p>

            </div>

            <div class="p-5 space-y-5">

                @foreach($invoiceStats ?? [] as $invoice)

                    <div>

                        <div class="flex justify-between mb-2">

                            <span class="text-sm text-gray-600">
                                {{ ucfirst($invoice->status) }}
                            </span>

                            <span class="text-sm font-semibold">
                                {{ $invoice->total }}
                            </span>

                        </div>

                        <div class="h-2 bg-gray-100 rounded-full overflow-hidden">

                            <div
                                class="h-full bg-blue-600 rounded-full"
                                style="width: {{ $invoice->percentage ?? 0 }}%">
                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </div>

</div>

@endsection
