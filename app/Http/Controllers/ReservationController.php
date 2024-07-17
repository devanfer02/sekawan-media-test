<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Services\ReservationService;

class ReservationController extends Controller
{
    private $reservationSvc;

    public function __construct()
    {
        $this->reservationSvc = new ReservationService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = $this->reservationSvc->fetch(10);

        return view('pages.reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $vehicles = Vehicle::all();
        $users = User::with('role')->whereHas('role', function($query) {
            $query->where('role_name', '=', 'Approver');
        })->get();


        return view('pages.reservations.create', compact('vehicles', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->rules(), $this->rulesMessage());

        try {

            $this->reservationSvc->store($request);

            return redirect()->route('reservations.pages.index')->with('success', 'Successfully create new reservation');

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        $reservation->load('vehicle', 'approvals', 'approvals.approver');

        $vehicles = Vehicle::all();

        $users = User::with('role')->whereHas('role', function($query) {
            $query->where('role_name', '=', 'Approver');
        })->get();

        return view('pages.reservations.edit', compact('reservation', 'vehicles', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        $request->validate($this->rules(), $this->rulesMessage());
        try {
            $this->reservationSvc->update($request, $reservation);

            return redirect()->route('reservations.pages.index')->with('success', "Successfully update reservation");

        } catch(\Exception $e) {
            return redirect()->back()->withInput()->with('failed', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }

    private function rules()
    {
        return [
            'driver_name' => 'required|min:3',
            'destination' => 'required|min:3',
            'start_date' => 'required|date',
            'end_date' => 'required|date'
        ];
    }

    private function rulesMessage()
    {
        return [
            'driver_name.required' => 'Nama Pengemudi wajib diisi',
            'driver_name.min' => 'Nama Pengemudi wajib memiliki minimal 3 karakter',
            'destination.required' => 'Tujuan wajib diisi',
            'destination.min' => 'Tujuan wajib memiliki minimal 3 karakter',
            'start_date.required' => 'Tanggal mulai wajib diisi',
            'start_date.date' => 'Tanggal mulai wajib merupakan tanggal yang valid',
            'end_date.required' => 'Tanggal selesai wajib diisi',
            'end_date.date' => 'Tanggal selesai wajib merupakan tanggal yang valid',
        ];
    }
}
