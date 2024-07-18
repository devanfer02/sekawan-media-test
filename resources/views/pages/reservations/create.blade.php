<x-app-layout>
  <div class="container">
    <div class="tw-w-full tw-mb-5">
      <div class="tw-flex tw-justify-between tw-my-2">
        <h1 class="tw-text-xl lg:tw-text-3xl">Buat Pemesanan</h1>
      </div>
      <div class="tw-w-full tw-h-[1px] tw-bg-secondary"></div>
    </div>
    <form action="{{ route('reservations.request.store') }}" method="POST" class="tw-border tw-border-secondary tw-rounded-md tw-px-4 lg:tw-px-8 tw-py-5">
      @csrf
      <x-input
        type="text"
        name="Nama Pengemudi"
        id="driver_name"
        required
        placeholder="Masukkan nama pengemudi"
        value="{{ old('driver_name') }}"
      />
      <div class="tw-mb-3">
        <label for="vehicle_name" class="tw-block tw-mb-1 lg:tw-text-lg">Tipe Kendaraan <span class="tw-text-red-500">*</span></label>
        <select name="vehicle_name" id="vehicle_name" class="tw-w-full tw-border tw-border-secondary tw-rounded-md" required>
          @if(old('vehicle_name'))
          <option value="{{ old('vehicle_name') }}" class="tw-hidden">{{ old('vehicle_name') }}</option>
          @else
          <option value="" class="tw-hidden">Pilih Kendaraan</option>
          @endif
          @foreach($vehicles as $vehicle)
          <option value="{{ $vehicle->vehicle_name }}">{{ $vehicle->vehicle_name }}</option>
          @endforeach
        </select>
      </div>
      <x-input
        type="text"
        name="Tujuan"
        id="destination"
        required
        placeholder="Masukkan tujuan"
        value="{{ old('destination') }}"
      />
      <x-input
        type="text"
        name="Biaya Bensin"
        id="fuel_cost"
        required
        placeholder="Masukkan biaya bensin"
        value="{{ old('fuel_cost') }}"
      />
      <div class="tw-mb-3 tw-flex">
        <div class="tw-w-1/2 tw-mr-1">
          <label for="start_date" class="tw-block tw-mb-1 lg:tw-text-lg">Tanggal Mulai <span class="tw-text-red-500">*</span></label>
          <input type="date" id="start_date" name="start_date" class="tw-w-full tw-border tw-border-secondary tw-rounded-md" value="{{ old('start_date') }}">
        </div>
        <div class="tw-w-1/2 tw-ml-1">
          <label for="end_date" class="tw-block tw-mb-1 lg:tw-text-lg">Tanggal Selesai <span class="tw-text-red-500">*</span></label>
          <input type="date" id="end_date" name="end_date" class="tw-w-full tw-border tw-border-secondary tw-rounded-md" value="{{ old('end_date') }}">
        </div>
      </div>
      <div class="tw-w-full tw-mb-3">
        <div class="form-group col-sm-8 tw-w-full">
          <label for="myMultiselect" class="lg:tw-text-lg">Pihak Penyetuju <span class="tw-text-red-500">*</span></label>
          <div id="myMultiselect" class="multiselect">
            <div id="mySelectLabel" class="selectBox" onclick="toggleCheckboxArea()">
              <select class="tw-rounded-md tw-border tw-border-secondary" required name="approvers">
                <option value="">somevalue</option>
              </select>
              <div class="overSelect"></div>
            </div>
            <div id="mySelectOptions" class="tw-rounded-md tw-border tw-border-secondary">
              @foreach($users as $user)
              <label for="{{ $user->fullname }}"><input type="checkbox" id="{{ $user->fullname }}" onchange="checkboxStatusChange()" value="{{ $user->fullname }}" /> {{ $user->fullname }}</label>
              @endforeach
            </div>
          </div>
        </div>
      </div>
      <div class="tw-mb-3">
        <button class="tw-w-full tw-border tw-border-secondary tw-bg-secondary tw-text-white tw-py-2 tw-rounded-md hover:tw-bg-white hover:tw-text-secondary tw-duration-300 tw-ease-in-out">Buat Pemesanan</button>
      </div>
      <x-alert />
    </form>
  </div>
</x-app-layout>
