<?php

namespace App\Exports;

use App\Models\Reservation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReservationExport implements WithHeadings, FromCollection, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $reservations = Reservation::with([
            'approvals',
            'approvals.approver',
            'vehicle',
            'admin'
        ])->get();

        foreach($reservations as $reservation)
        {
            $reservation['vehicle_id'] = $reservation->vehicle->vehicle_name;
            $reservation['admin_id'] = $reservation->admin->fullname;

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

    public function styles(Worksheet $worksheet)
    {
        return [
            1 => ['font' => ['bold' => true]]
        ];
    }

    public function headings(): array
    {
        return [
            'ID Pemesanan',
            'Nama Kendaraan',
            'Nama Pemesan',
            'Nama Pengemudi',
            'Tujuan',
            'Biaya Bensin',
            'Tanggal Mulai',
            'Tanggal Selesai',
            'Tanggal Pengajuan',
            'Tanggal Perbarui',
            'Status'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();

                // Apply border to all cells
                $sheet->getStyle('A1:' . $highestColumn . $highestRow)
                      ->getBorders()
                      ->getAllBorders()
                      ->setBorderStyle(Border::BORDER_THIN);
            },
        ];
    }
}
