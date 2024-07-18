<?php

namespace App\Http\Services;

use DateTime;
use Amp;
use App\Models\Reservation;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;

class StatisticsService
{
    public function getVehicleUsagePerMonth(int $months = 6)
    {
        $months = $this->getMonths($months);

        $vehicleUsage = [];

        foreach($months as $month)
        {
            $splitted = explode("-", $month['date']);

            $vehicleUsage[$month['month']] = Amp\async(function() use($splitted) {
                $reservations = Reservation::whereYear('created_at', $splitted[0])
                ->whereMonth('created_at', $splitted[1])
                ->get();

                return $reservations->count();
            });
        }

        $usageDataMonth = [];

        foreach($months as $month)
        {
            $vehicleUsage[$month['month']] = $vehicleUsage[$month['month']]->await();
            $usageDataMonth['labels'][] = $month['month'];
            $usageDataMonth['data'][] = $vehicleUsage[$month['month']];
        }

        return $usageDataMonth;
    }

    public function getTopKVehicle(int $K = 10)
    {
        $vehicles = Vehicle::withCount('reservations')->orderByDesc('reservations_count')->limit($K)->get();
        $topKUsage = [];

        foreach($vehicles as $vehicle)
        {
            $topKUsage['data'][] = $vehicle->reservations_count;
            $topKUsage['labels'][] = $vehicle->vehicle_name;
        }

        return $topKUsage;
    }

    public function getVehicleUsageByType()
    {
        $reservations = Reservation::join('vehicles', 'reservations.vehicle_id', '=', 'vehicles.vehicle_id')
        ->select('vehicles.vehicle_type', DB::raw('count(*) as count'))
        ->groupBy('vehicles.vehicle_type')
        ->get();

        $usageType = [];

        foreach($reservations as $reservation)
        {
            $usageType['data'][] = $reservation->count;
            $usageType['labels'][] = $reservation->vehicle_type;
        }

        return $usageType;
    }

    private function getMonths(int $prevMonths = 6): array
    {
        $currDate = new DateTime();

        $months = [];

        foreach(range(1, $prevMonths) as $idx)
        {
            $months[] = [
                'date' => $currDate->format('Y-m'),
                'month' => $currDate->format('F Y')
            ];

            $currDate->modify('-1 month');
        }

        $months = array_reverse($months);

        return $months;
    }
}
