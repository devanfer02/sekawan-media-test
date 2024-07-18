<x-app-layout>
  <div class="container">
    <div class="tw-w-full tw-mb-5">
      <div class="tw-flex tw-justify-between tw-my-2">
        <h1 class="tw-text-xl lg:tw-text-3xl">List Kendaraan</h1>
        @if(auth()->user()->load('role')->role->role_name === "Admin")
        <a href="{{ route('vehicles.pages.create') }}" class="btn btn-success">Tambah</a>
        @endif
      </div>
      <x-alert />
      <div class="tw-w-full tw-h-[1px] tw-bg-secondary"></div>
    </div>
    <div class="tw-mb-5">
      <table class="tw-w-full">
        <thead>
          <tr class="tw-border tw-border-secondary tw-bg-secondary ">
            <th class="tw-py-2 tw-text-white tw-text-center">No</th>
            <th class="tw-py-2 tw-text-white">Nama Kendaraan</th>
            <th class="tw-py-2 tw-text-white">Tipe Kendaraan</th>
            <th class="tw-py-2 tw-text-white">Pemilik Kendaraan</th>
            <th class="tw-py-2 tw-text-white tw-text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($vehicles as $vehicle)
          <tr class="tw-border tw-border-secondary">
            <td class="tw-py-2 tw-text-center">{{ $loop->iteration }}</td>
            <td class="tw-py-2">{{ $vehicle['vehicle_name'] }}</td>
            <td class="tw-py-2">{{ $vehicle['vehicle_type'] }}</td>
            <td class="tw-py-2">{{ $vehicle['vehicle_owner'] }}</td>
            <td class="tw-py-2 tw-flex tw-justify-center">
              <a href="{{ route('vehicles.pages.show', $vehicle) }}" class="btn btn-primary tw-mr-1">Riwayat</a>
              @if(auth()->user()->load('role')->role->role_name === "Admin")
              <a href="{{ route('vehicles.pages.edit', $vehicle) }}" class="btn btn-primary tw-ml-1">Edit</a>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="">
      {!! $vehicles->links() !!}
    </div>
  </div>
</x-app-layout>
