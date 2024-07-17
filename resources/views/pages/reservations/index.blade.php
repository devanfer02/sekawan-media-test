<x-app-layout>
  <div class="container">
    <div class="tw-w-full tw-mb-5">
      <div class="tw-flex tw-justify-between tw-my-2">
        <h1 class="tw-text-3xl">List Pemesanan</h1>
        <a href="{{ route('reservations.pages.create') }}" class="btn btn-success">Tambah</a>
      </div>
      <x-alert />
      <div class="tw-w-full tw-h-[1px] tw-bg-secondary"></div>
    </div>
    <div class="">
      <table class="tw-w-full">
        <thead>
          <tr class="tw-border tw-border-secondary tw-bg-secondary ">
            <th class="tw-py-2 tw-text-white tw-text-center">No</th>
            <th class="tw-py-2 tw-text-white">Nama Pemesan</th>
            <th class="tw-py-2 tw-text-white">Nama Kendaraan</th>
            <th class="tw-py-2 tw-text-white">Nama Pengemudi</th>
            <th class="tw-py-2 tw-text-white">Tujuan</th>
            <th class="tw-py-2 tw-text-white">Tanggal Mulai</th>
            <th class="tw-py-2 tw-text-white">Tanggal Selesai</th>
            <th class="tw-py-2 tw-text-white">Status</th>
            <th class="tw-py-2 tw-text-white tw-text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($reservations as $reservation)
          <tr class="tw-border tw-border-secondary">
            <td class="tw-py-2 tw-text-center">{{ $loop->iteration }}</td>
            <td class="tw-py-2">{{ $reservation->admin->fullname }}</td>
            <td class="tw-py-2">{{ $reservation->vehicle->vehicle_name }}</td>
            <td class="tw-py-2">{{ $reservation->driver_name }}</td>
            <td class="tw-py-2">{{ $reservation->destination }}</td>
            <td class="tw-py-2">{{ $reservation->start_date }}</td>
            <td class="tw-py-2">{{ $reservation->end_date }}</td>
            <td class="tw-py-2">
              <span class="tw-py-2 tw-px-2 tw-rounded-md tw-text-white
                {{ $reservation->status == "Approved" ? "tw-bg-blue-500" : "" }}
                {{ $reservation->status == "Pending" ? "tw-bg-yellow-500" : "" }}
                {{ $reservation->status == "Approved" ? "tw-bg-red-500" : "" }}
                ">
                {{ $reservation->status }}
              </span>
            </td>
            <td class="tw-py-2 tw-flex tw-justify-center">
              <a href="" class="btn btn-primary tw-mr-1">Detail</a>
              <a href="{{ route('reservations.pages.edit', $reservation) }}" class="btn btn-primary tw-ml-1">Edit</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    {!! $reservations->links() !!}
  </div>
</x-app-layout>
