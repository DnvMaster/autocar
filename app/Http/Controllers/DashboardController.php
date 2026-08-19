<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Rental;
use App\Models\Vehicle;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $revenue = Invoice::where('status', 'paid')->sum('total');
        $currentMonthRevenue = Invoice::where('status', 'paid')->whereYear('issued_at', now()->year)->whereMonth('issued_at', now()->month)->sum('total');
        $previousMonthRevenue = Invoice::where('status', 'paid')->whereYear('issued_at', now()->subMonth()->year)->whereMonth('issued_at', now()->subMonth()->month)->sum('total');
        $revenueGrowth = $previousMonthRevenue > 0 ? round((($currentMonthRevenue - $previousMonthRevenue) / $previousMonthRevenue) * 100, 1) : ($currentMonthRevenue > 0 ? 100 : 0);
        $activeRentals = Rental::where('status', 'active')->count();
        $vehicles = Vehicle::count();
        $outstanding = Invoice::whereIn('status', ['issued','overdue'])->sum('total');
        $previousMonthOutstanding = Invoice::whereIn('status', ['issued','overdue'])->where(function ($query) {$query->whereYear('due_at', now()->subMonth()->year)->whereMonth('due_at', now()->subMonth()->month);})->sum('total');
        $outstandingGrowth = $previousMonthOutstanding > 0 ? round((($outstanding - $previousMonthOutstanding) / $previousMonthOutstanding) * 100, 1) : ($outstanding > 0 ? 100 : 0);
        $availableVehicles = Vehicle::where('status', 'available')->count();
        $reservedVehicles = Vehicle::where('status', 'reserved')->count();
        $rentedVehicles = Vehicle::where('status', 'rented')->count();
        $maintenanceVehicles = Vehicle::where('status', 'maintenance')->count();
        $fleetUtilization = $vehicles > 0 ? round((($reservedVehicles + $rentedVehicles) / $vehicles) * 100): 0;
        $recentRentals = Rental::with(['customer','vehicle'])->latest('created_at') ->limit(8)->get();
        $rentalTotal = Rental::count();
        $activeRentals = Rental::where('status', 'active')->count();
        $previousMonthActiveRentals = Rental::where('status', 'active')->whereYear('created_at', now()->subMonth()->year)->whereMonth('created_at', now()->subMonth()->month)->count();
        $activeRentalsGrowth = $previousMonthActiveRentals > 0 ? round((($activeRentals - $previousMonthActiveRentals) / $previousMonthActiveRentals) * 100, 1) : ($activeRentals > 0 ? 100 : 0);

        $rentalStats = Rental::select('status')->selectRaw('COUNT(*) as total')->groupBy('status')->orderByDesc('total')->get() ->map(function ($rental) use ($rentalTotal) {
            $rental->percentage = $rentalTotal > 0  ? round(($rental->total / $rentalTotal) * 100) : 0;
            return $rental;
        });
        $invoiceTotal = Invoice::count();

        $invoiceStats = Invoice::select('status')->selectRaw('COUNT(*) as total')->groupBy('status')->orderByDesc('total')->get()->map(function ($invoice) use ($invoiceTotal) {
            $invoice->percentage = $invoiceTotal > 0 ? round(($invoice->total / $invoiceTotal) * 100) : 0;
            return $invoice;
        });

        $revenueByMonth = Invoice::query()->selectRaw('MONTH(issued_at) as month')->selectRaw('SUM(total) as total')->where('status', 'paid')->whereYear('issued_at', now()->year)->groupByRaw('MONTH(issued_at)')->orderBy('month')->pluck('total', 'month');
        $revenueMonths = collect(range(1, 12))->map(function ($month) use ($revenueByMonth) {
            return ['month' => $month,'total' => (float) ($revenueByMonth[$month] ?? 0)];
        });

        return view('dashboard', [
            'stats' => [
                'revenue' => $revenue,
                'current_month_revenue' => $currentMonthRevenue,
                'previous_month_revenue' => $previousMonthRevenue,
                'revenue_growth' => $revenueGrowth,
                'active_rentals' => $activeRentals,
                'active_rentals_growth' => $activeRentalsGrowth,
                'vehicles' => $vehicles,
                'outstanding' => $outstanding,
                'outstanding_growth' => $outstandingGrowth,
                'available_vehicles' => $availableVehicles,
                'reserved_vehicles' => $reservedVehicles,
                'rented_vehicles' => $rentedVehicles,
                'maintenance_vehicles' => $maintenanceVehicles,
                'fleet_utilization' => $fleetUtilization,
            ],
            'recentRentals' => $recentRentals,
            'rentalStats' => $rentalStats,
            'invoiceStats' => $invoiceStats,
            'revenueByMonth' => $revenueByMonth,
            'revenueMonths' => $revenueMonths,
        ]);
    }
}
