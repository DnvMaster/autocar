<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VehicleImageController extends Controller
{
    public function store(Request $request, Vehicle $vehicle): RedirectResponse
    {
        //dd($request->all(), $request->allFiles());
        $request->validate([
            'images' => ['required','array'],
            'images.*' => ['image','max:4096'],
        ]);

        foreach ($request->file('images') as $image) {
            $path = $image->store('vehicles','public');
            VehicleImage::create([
                'vehicle_id' => $vehicle->id,
                'path' => $path,
                'is_primary' => false,
                'sort_order' => $vehicle->images()->count()
            ]);
        }
        return back()->with('success','Фотографии успешно добавлены.');
    }
}
