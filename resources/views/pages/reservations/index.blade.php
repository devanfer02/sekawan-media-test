<x-app-layout>
  <div class="container">
    <div class="tw-w-full tw-mb-5">
      <div class="tw-flex tw-justify-between tw-my-2">
        <h1 class="tw-text-3xl">List Pemesanan</h1>
        <div>
          @if(auth()->user()->load('role')->role->role_name == "Approver")
          <a href="{{ route('reservations.pages.index', ['status' => 'Approved']) }}" class="btn {{ request('status') === "Approved" ? "tw-border tw-border-blue-500 tw-text-blue-500" : "btn-primary" }}">Disetujui</a>
          <a href="{{ route('reservations.pages.index', ['status' => 'Rejected']) }}" class="btn {{ request('status') === "Rejected" ? "tw-border tw-border-red-500 tw-text-red-500" : "btn-danger" }}">Ditolak</a>
          <a href="{{ route('reservations.pages.index', ['status' => 'Pending']) }}" class="btn {{ request('status') === "Pending" ? "tw-border tw-border-yellow-500 tw-text-yellow-500" : "btn-warning" }}">Menunggu</a>
          @else
          <a class="tw-mr-1 btn btn-primary" target="_blank" href="{{ route('reservations.request.export.excel') }}">Export Excel</a>
          <a href="{{ route('reservations.pages.create') }}" class="btn btn-success tw-ml-1">Tambah</a>
          @endif
        </div>
      </div>
      <x-alert />
      <div class="tw-w-full tw-h-[1px] tw-bg-secondary"></div>
    </div>
    <div class="">
      <table class="tw-w-full">
        <thead>
          <tr class="tw-border tw-border-secondary tw-bg-secondary ">
            <th class="tw-py-2 tw-text-white tw-text-center">No</th>
            {{-- <th class="tw-py-2 tw-text-white">Nama Pemesan</th> --}}
            <th class="tw-py-2 tw-text-white">Nama Kendaraan</th>
            <th class="tw-py-2 tw-text-white">Nama Pengemudi</th>
            <th class="tw-py-2 tw-text-white">Tujuan</th>
            <th class="tw-py-2 tw-text-white">Biaya Bensin</th>
            <th class="tw-py-2 tw-text-white">Tanggal Mulai</th>
            <th class="tw-py-2 tw-text-white">Tanggal Selesai</th>
            <th class="tw-py-2 tw-text-white tw-text-center">Status</th>
            <th class="tw-py-2 tw-text-white tw-text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($reservations as $reservation)
          <tr class="tw-border tw-border-secondary">
            <td class="tw-py-2 tw-text-center">{{ $loop->iteration }}</td>
            {{-- <td class="tw-py-2">{{ $reservation->admin->fullname }}</td> --}}
            <td class="tw-py-2">{{ $reservation->vehicle->vehicle_name }}</td>
            <td class="tw-py-2">{{ $reservation->driver_name }}</td>
            <td class="tw-py-2">{{ $reservation->destination }}</td>
            <td class="tw-py-2">{{ $reservation->fuel_cost }}</td>
            <td class="tw-py-2">{{ $reservation->start_date }}</td>
            <td class="tw-py-2">{{ $reservation->end_date }}</td>
            <td class="tw-py-2 tw-text-center">
              <span class="tw-py-2 tw-px-2 tw-rounded-md tw-text-white
                {{ $reservation->status == "Approved" ? "tw-bg-blue-500" : "" }}
                {{ $reservation->status == "Pending" ? "tw-bg-yellow-500" : "" }}
                {{ $reservation->status == "Rejected" ? "tw-bg-red-500" : "" }}
                ">
                {{ $reservation->status }}
              </span>
            </td>
            <td class="tw-py-2 tw-flex tw-justify-center">
              <a href="{{ route('reservations.pages.show', $reservation) }}" class="btn btn-primary tw-mr-1">Detail</a>
              @if(auth()->user()->load('role')->role->role_name === "Admin")
              <a href="{{ route('reservations.pages.edit', $reservation) }}" class="btn btn-primary tw-ml-1">Edit</a>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    {!! $reservations->links() !!}
  </div>
</x-app-layout>
