<?php

namespace App\Http\Controllers;

use App\Http\Services\StatisticsService;
use Illuminate\Http\Request;

class PageController extends Controller
{
    private $statSvc;

    public function __construct()
    {
        $this->statSvc = new StatisticsService();
    }

    public function dashboard()
    {
        $usageDataMonth = $this->statSvc->getVehicleUsagePerMonth();
        $top10Usage = $this->statSvc->getTopKVehicle();
        $usageType = $this->statSvc->getVehicleUsageByType();


        $data = compact('usageDataMonth', 'top10Usage', 'usageType');

        return view('pages.dashboard', compact('data'));
    }

    public function login()
    {
        return view('pages.auth.login');
    }

    public function register()
    {
        return view('pages.auth.register');
    }

    public function vehicle()
    {
        return view('pages.vehicles.index');
    }

    public function reservation()
    {
        return view('pages.reservations.index');
    }

    public function log()
    {
        return view('pages.logs.index');
    }

    public function notFound()
    {
        return view('pages.notfound');
    }
}
