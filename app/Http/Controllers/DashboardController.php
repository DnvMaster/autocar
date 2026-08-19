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
        $activeRentals = Rental::where('status', 'active')->count();
        $vehicles = Vehicle::count();
        $outstanding = Invoice::whereIn('status', ['issued','overdue'])->sum('total');
        $recentRentals = Rental::with(['customer','vehicle'])->latest('created_at')->limit(8)->get();
        $invoiceTotal = Invoice::count();
        $invoiceStats = Invoice::select('status')->selectRaw('COUNT(*) as total')->groupBy('status')->orderByDesc('total')->get()
            ->map(function ($invoice) use ($invoiceTotal) {
                $invoice->percentage = $invoiceTotal > 0 ? round(($invoice->total / $invoiceTotal) * 100) : 0;
                return $invoice;
        });
        return view('dashboard', [
            'stats' => [
                'revenue' => $revenue,
                'active_rentals' => $activeRentals,
                'vehicles' => $vehicles,
                'outstanding' => $outstanding
            ],
            'recentRentals' => $recentRentals,
            'invoiceStats' => $invoiceStats,
        ]);
    }
}
