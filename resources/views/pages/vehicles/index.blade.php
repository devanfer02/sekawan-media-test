<x-app-layout>
  <div class="container">
    <div class="tw-w-full tw-mb-5">
      <div class="tw-flex tw-justify-between tw-my-2">
        <h1 class="tw-text-3xl">List Kendaraan</h1>
        <a href="{{ route('vehicles.pages.create') }}" class="btn btn-success">Tambah</a>
      </div>
      <x-alert />
      <div class="tw-w-full tw-h-[1px] tw-bg-secondary"></div>
    </div>
    <div class="">
      <table class="tw-w-full">
        <thead>
          <tr class="tw-border tw-border-secondary tw-bg-secondary ">
            <th class="tw-py-2 tw-text-white tw-text-center">No</th>
            <th class="tw-py-2 tw-text-white">Nama Kendaraan</th>
            <th class="tw-py-2 tw-text-white">Tipe Kendaraan</th>
            <th class="tw-py-2 tw-text-white tw-text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($vehicles as $vehicle)
          <tr class="tw-border tw-border-secondary">
            <td class="tw-py-2 tw-text-center">{{ $loop->iteration }}</td>
            <td class="tw-py-2">{{ $vehicle['vehicle_name'] }}</td>
            <td class="tw-py-2">{{ $vehicle['vehicle_type'] }}</td>
            <td class="tw-py-2 tw-flex tw-justify-center">
              <a href="" class="btn btn-primary tw-mr-1">Riwayat</a>
              <a href="{{ route('vehicles.pages.edit', $vehicle) }}" class="btn btn-primary tw-ml-1">Edit</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    {!! $vehicles->links() !!}
  </div>
</x-app-layout>
