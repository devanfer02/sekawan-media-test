<x-app-layout>
  <div class="container">
    <div class="tw-w-full tw-mb-5">
      <div class="tw-flex tw-justify-between tw-my-2">
        <h1 class="tw-text-3xl">Kendaraan {{ $vehicle->vehicle_name }}</h1>
      </div>
      <x-alert />
      <div class="tw-w-full tw-h-[1px] tw-bg-secondary tw-mb-5"></div>
      <div class="">
        <div class="card tw-py-4 tw-px-5 tw-mb-5">
          <table>
            <tbody>
              <tr>
                <td class="lg:tw-text-lg tw-w-2/6 lg:tw-w-1/6">Nama Kendaraan</td>
                <td class="lg:tw-text-lg tw-w-5/6">: {{ $vehicle->vehicle_name }}</td>
              </tr>
              <tr>
                <td class="lg:tw-text-lg tw-w-2/6 lg:tw-w-1/6">Tipe Kendaraan</td>
                <td class="lg:tw-text-lg tw-w-5/6">: {{ $vehicle->vehicle_type }}</td>
              </tr>
              <tr>
                <td class="lg:tw-text-lg tw-w-2/6 lg:tw-w-1/6">Pemilik Kendaran</td>
                <td class="lg:tw-text-lg tw-w-5/6">: {{ $vehicle->vehicle_owner }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="tw-w-full tw-mt-4 tw-mb-2">
          <h1 class="tw-text-2xl">Riwayat Reservasi</h1>
        </div>
        <div class="tw-w-full tw-h-[1px] tw-bg-secondary tw-mb-2"></div>
        <div class="tw-w-full">
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
              <th class="tw-py-2 tw-text-white tw-text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($vehicle->reservations as $reservation)
            <tr class="tw-border tw-border-secondary">
              <td class="tw-py-2 tw-text-center">{{ $loop->iteration }}</td>
              {{-- <td class="tw-py-2">{{ $reservation->admin->fullname }}</td> --}}
              <td class="tw-py-2">{{ $reservation->vehicle->vehicle_name }}</td>
              <td class="tw-py-2">{{ $reservation->driver_name }}</td>
              <td class="tw-py-2">{{ $reservation->destination }}</td>
              <td class="tw-py-2">{{ $reservation->fuel_cost }}</td>
              <td class="tw-py-2">{{ $reservation->start_date }}</td>
              <td class="tw-py-2">{{ $reservation->end_date }}</td>
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
      </div>
    </div>
    <div class="">
    </div>
  </div>
</x-app-layout>
