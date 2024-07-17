<?php

namespace App\Http\Services;

use App\Exceptions\ServiceException;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Approval;
use App\Models\Vehicle;
use Amp;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Services\LogService;
use Illuminate\Database\Eloquent\Collection;

class ReservationService
{
    private $logSvc;

    public function __construct()
    {
        $this->logSvc = new LogService();
    }

    public function fetch(int $pagination = 10, array $filters = [])
    {
        $reservations = Reservation::with([
            'vehicle',
            'admin',
            'approvals'
        ]);

        if (auth()->user()->load('role')->role->role_name === "Approver")
        {
            $filters['approver'] = auth()->user()->user_id;
            
            $reservations->filter($filters);
        }


        $reservations = $reservations->paginate($pagination);

        foreach($reservations as $reservation) {
            $isRejected = $reservation->approvals->contains('status', 'Rejected');

            if ($isRejected)
            {
                $reservation['status'] = "Rejected";
                continue;
            }

            $isApproved = $reservation->approvals->every('status', 'Approved');

            if ($isApproved)
            {
                $reservation['status'] = "Approved";
                continue;
            }

            $reservation['status'] = "Pending";
        }

        return $reservations;
    }

    public function fetchOne(Reservation $reservation)
    {
        $reservation->load('vehicle', 'approvals', 'approvals.approver', 'admin');

        $isRejected = $reservation->approvals->contains('status', 'Rejected');

        if ($isRejected)
        {
            $reservation['status'] = "Rejected";
            return $reservation;
        }

        $isApproved = $reservation->approvals->every('status', 'Approved');

        if ($isApproved)
        {
            $reservation['status'] = "Approved";
            return $reservation;
        }

        $reservation['status'] = "Pending";

        return $reservation;
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            if (!isset($request['approvers']))
            {
                throw new ServiceException("Pihak penyetuju belum diisi");
            }

            $vehicle = Amp\async(function() use($request) {
                $vehicle = Vehicle::where('vehicle_name', '=', $request['vehicle_name'])->first();

                return $vehicle;
            });

            $users = Amp\async(function() use($request) {
                $usersName = explode(", ", $request['approvers']);

                $users = User::whereIn('fullname', $usersName)->get();

                return $users;
            });

            $vehicle = $vehicle->await();
            $users = $users->await();

            if (!isset($vehicle))
            {
                throw new ServiceException("Kendaraan tidak dapat ditemukan");
            }

            if (count($users) <= 0)
            {
                throw new ServiceException("Pihak penyetuju tidak dapat ditemukan");
            }

            if (count($users) < 2)
            {
                throw new ServiceException("Minimal memperlukan 2 pihak penyetuju ");
            }

            $startDate = Carbon::parse($request['start_date']);
            $endDate = Carbon::parse($request['end_date']);

            if ($startDate->greaterThan($endDate))
            {
                throw new ServiceException("Tanggal selesai seharusnya lebih lama dibandingkan tanggal mulai");
            }

            $data = [
                'vehicle_id' => $vehicle->vehicle_id,
                'admin_id' => auth()->user()->user_id,
            ];

            $data = array_merge($data, $request->only(['driver_name', 'destination', 'start_date', 'end_date']));

            $reservation = Reservation::create($data);

            $asyncTask = [];

            foreach($users as $user)
            {
                $asyncTask["$user->user_id"] = Amp\async(function() use($user, $reservation) {
                    $data = [
                        'reservation_id' => $reservation->reservation_id,
                        'approver_id' => $user->user_id,
                        'status' => 'Pending',
                        'comments' => '',

                    ];
                    Approval::create($data);
                });
            }

            foreach($users as $user)
            {
                $asyncTask["$user->user_id"]->await();
            }

            $this->logSvc->create('membuat pemesanan kendaraan ' . $vehicle->vehicle_name);

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();

            if (!($e instanceof ServiceException ))
            {
                error_log("ReservationService: " . $e->getMessage());

                throw new Exception("Failed to create new reservation");
            }

            throw $e;
        }
    }

    public function update(Request $request, Reservation $reservation)
    {
        try {
            DB::beginTransaction();

            if (!isset($request['approvers']))
            {
                throw new ServiceException("Pihak penyetuju belum diisi");
            }

            $users = Amp\async(function() use($request) {
                $usersName = explode(", ", $request['approvers']);

                $users = User::whereIn('fullname', $usersName)->get();

                return $users;
            });

            if ($request['vehicle_name'] != $reservation->vehicle->vehicle_name) {
                $vehicle = Amp\async(function() use($request) {
                    $vehicle = Vehicle::where('vehicle_name', '=', $request['vehicle_name'])->first();

                    return $vehicle;
                });

                $vehicle = $vehicle->await();

                if (!$vehicle)
                {
                    throw new ServiceException("Kendaraan tidak dapat ditemukan");
                }

                $reservation->vehicle_id = $vehicle->vehicle_id;
            }

            $users = $users->await();

            if (count($users) <= 0)
            {
                throw new ServiceException("Pihak penyetuju tidak dapat ditemukan");
            }

            if (count($users) < 2)
            {
                throw new ServiceException("Minimal memperlukan 2 pihak penyetuju ");
            }

            $startDate = Carbon::parse($request['start_date']);
            $endDate = Carbon::parse($request['end_date']);

            if ($startDate->greaterThan($endDate))
            {
                throw new ServiceException("Tanggal selesai seharusnya lebih lama dibandingkan tanggal mulai");
            }

            $reservation->fill($request->only(['driver_name', 'destination', 'start_date', 'end_date']))->save();

            $asyncTaskNewApprover = [];
            $asyncTaskOldApprover = [];

            foreach($users as $user)
            {
                if ($reservation->approvals->contains('approver_id', $user->user_id))
                {
                    continue;
                }

                $asyncTaskNewApprover["$user->user_id"] = Amp\async(function() use($user, $reservation) {
                    $data = [
                        'reservation_id' => $reservation->reservation_id,
                        'approver_id' => $user->user_id,
                        'status' => 'Pending',
                        'comments' => '',

                    ];
                    Approval::create($data);
                });
            }

            foreach($reservation->approvals as $approval)
            {
                if ($users->contains('user_id', $approval->approver_id))
                {
                    continue;
                }

                if ($approval->status == "Rejected" || $approval->status == "Approved")
                {
                    throw new ServiceException("Pihak penyetuju yang ingin dihapus sudah melakukan aksi");
                }

                $asyncTaskOldApprover["$approval->approver_id"] = Amp\async(function() use($approval)  {
                    $approval->delete();
                });
            }

            foreach($asyncTaskNewApprover as $task)
            {
                $task->await();
            }

            foreach($asyncTaskOldApprover as $task)
            {
                $task->await();
            }

            $this->logSvc->create('memperbarui data pemesanan kendaraan ' . $reservation->vehicle->vehicle_name);

            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();

            if (!($e instanceof ServiceException ))
            {
                error_log("ReservationService: " . $e->getMessage());

                throw new Exception("Failed to create new reservation");
            }

            throw $e;
        }
    }
}
