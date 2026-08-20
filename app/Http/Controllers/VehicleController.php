<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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

    public function create(): View
    {
        $categories = VehicleCategory::where('is_active', true)->orderBy('name')->get();
        return view('vehicles.create', ['categories' => $categories]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'category_id' => ['required','exists:vehicle_categories,id'],
            'brand' => ['required','string','max:255'],
            'model' => ['required','string','max:255'],
            'year' => ['required','integer','min:1900','max:' . date('Y')],
            'license_plate' => ['required','string','max:50','unique:vehicles,license_plate'],
            'vin' => ['nullable','string','max:50','unique:vehicles,vin'],
            'color' => ['nullable','string','max:100'],
            'transmission' => ['required',Rule::in(['manual','automatic'])],
            'fuel_type' => ['required'],
            'seats' => ['required','integer'],
            'mileage' => ['required','integer'],
            'daily_rate' => ['required','numeric'],
            'status' => ['required',Rule::in(['available','reserved','rented','maintenance'])],
            'description' => ['nullable','string'],
        ]);
        Vehicle::create($data);
        return redirect()->route('vehicles.index')->with('success', 'Автомобиль успешно добавлен.');
    }

    public function show(Vehicle $vehicle): View
    {
        $vehicle->load(['category','maintenance','expenses']);
        return view('vehicles.show', ['vehicle' => $vehicle]);
    }

    public function edit(Vehicle $vehicle): View
    {
        $categories = VehicleCategory::where('is_active', true)->orderBy('name')->get();
        return view('vehicles.edit', ['vehicle' => $vehicle,'categories' => $categories]);
    }

    public function update(Request $request, Vehicle $vehicle): RedirectResponse
    {
        $data = $request->validate([
            'category_id' => ['required','exists:vehicle_categories,id'],
            'brand' => ['required','string','max:255'],
            'model' => ['required','string','max:255'],
            'year' => ['required','integer'],
            'license_plate' => ['required','unique:vehicles,license_plate,' . $vehicle->id],
            'vin' => ['nullable','unique:vehicles,vin,' . $vehicle->id],
            'color' => 'nullable|string',
            'transmission' => 'required',
            'fuel_type' => 'required',
            'seats' => 'required|integer',
            'mileage' => 'required|integer',
            'daily_rate' => 'required|numeric',
            'status' => 'required',
            'description' => 'nullable|string',
        ]);
        $vehicle->update($data);
        return redirect()->route('vehicles.show', $vehicle)->with('success', 'Данные автомобиля обновлены.');
    }
}
