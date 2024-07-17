<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use Exception;

class VehicleService
{
    public function store(Request $request)
    {
        try {
            Vehicle::insert($request->only('vehicle_name', 'vehicle_type'));
        } catch (\Exception $e) {
            error_log("VehicleService: " . $e->getMessage());

            throw new Exception("Failed to create new vehicle");
        }
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        try {
            $vehicle->fill($request->only('vehicle_name', 'vehicle_type'))->save();
        } catch(\Exception $e) {
            error_log("VehicleService: " . $e->getMessage());

            throw new Exception("Failed to create new vehicle");
        }
    }
}
