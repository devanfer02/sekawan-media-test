<x-app-layout>
  <div class="container">
    <div class="tw-w-full tw-mb-5">
      <div class="tw-flex tw-justify-between tw-my-2">
        <h1 class="tw-text-3xl">Tambah Kendaraan</h1>
      </div>
      <div class="tw-w-full tw-h-[1px] tw-bg-secondary"></div>
    </div>
    <form action="{{ route('vehicles.request.store') }}" method="POST" class="tw-border tw-border-secondary tw-rounded-md tw-px-8 tw-py-5">
      @csrf
      <x-input
        type="text"
        name="Nama Kendaraan"
        id="vehicle_name"
        required
        placeholder="Masukkan nama kendaraan"
        value="{{ old('vehicle_name') }}"
      />
      <div class="tw-mb-3">
        <label for="vehicle_type" class="tw-block tw-mb-1 lg:tw-text-lg">Tipe Kendaraan</label>
        <select name="vehicle_type" id="vehicle_type" class="tw-w-full tw-border tw-border-secondary tw-rounded-md" required>
          <option value="" class="tw-hidden">Pilih Tipe Kendaraan</option>
          <option value="Person">Person</option>
          <option value="Cargo">Cargo</option>
        </select>
      </div>
      <div class="tw-mb-3">
        <label for="vehicle_owner" class="tw-block tw-mb-1 lg:tw-text-lg">Pemilik Kendaraan</label>
        <select name="vehicle_owner" id="vehicle_owner" class="tw-w-full tw-border tw-border-secondary tw-rounded-md" required>
          <option value="" class="tw-hidden">Pilih Pemilik Kendaraan</option>
          <option value="Company">Company</option>
          <option value="Rental">Rental</option>
        </select>
      </div>
      <div class="tw-mb-3">
        <button class="tw-w-full tw-border tw-border-secondary tw-bg-secondary tw-text-white tw-py-2 tw-rounded-md hover:tw-bg-white hover:tw-text-secondary tw-duration-300 tw-ease-in-out">Tambah Kendaraan</button>
      </div>
      <x-alert />
    </form>
  </div>
</x-app-layout>
