<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VehicleController extends Controller
{
    public function index(Request $request): View
    {
        $query = Vehicle::query()->with('category')->orderBy('brand')->orderBy('model');

        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->where('brand', 'like', "%{$search}%")->orWhere('model', 'like', "%{$search}%")->orWhere('license_plate', 'like', "%{$search}%")->orWhere('vin', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }

        if ($request->filled('brand')) {
            $query->where('brand', $request->input('brand'));
        }

        $vehicles = $query->paginate(12) ->withQueryString();
        $categories = VehicleCategory::query()->where('is_active', true)->orderBy('name')->get();
        $brands = Vehicle::query()->whereNotNull('brand')->where('brand', '!=', '')->distinct()->orderBy('brand')->pluck('brand');
        $vehicleStats = [
            'total' => Vehicle::count(),
            'available' => Vehicle::where('status', 'available')->count(),
            'reserved' => Vehicle::where('status', 'reserved')->count(),
            'rented' => Vehicle::where('status', 'rented')->count(),
            'maintenance' => Vehicle::where('status', 'maintenance')->count(),
        ];
        return view('vehicles.index', [
            'vehicles' => $vehicles,
            'categories' => $categories,
            'brands' => $brands,
            'vehicleStats' => $vehicleStats,
        ]);
    }
    public function show(Vehicle $vehicle): View
    {
        $vehicle->load(['category','maintenance','expenses']);
        return view('vehicles.show', ['vehicle' => $vehicle]);
    }
}
