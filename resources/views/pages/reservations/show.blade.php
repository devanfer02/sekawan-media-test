<x-app-layout>
  <div class="container">
    <div class="tw-w-full tw-mb-5">
      <div class="tw-flex tw-justify-between tw-my-2">
        <h1 class="tw-text-xl lg:tw-text-3xl">Pemesanan #{{ $reservation->reservation_id }}</h1>
      </div>
      <x-alert />
      <div class="tw-w-full tw-h-[1px] tw-bg-secondary tw-mb-5"></div>
      <div class="">
        <div class="card tw-py-4 tw-px-5 tw-mb-5">
          <table>
            <tbody>
              <tr>
                <td class="lg:tw-text-lg tw-w-2/6 lg:tw-w-1/6">Nama Pengemudi</td>
                <td class="lg:tw-text-lg tw-w-5/6">: {{ $reservation->driver_name }}</td>
              </tr>
              <tr>
                <td class="lg:tw-text-lg tw-w-2/6 lg:tw-w-1/6">Nama Pengaju</td>
                <td class="lg:tw-text-lg tw-w-5/6">: {{ $reservation->admin->fullname }}</td>
              </tr>
              <tr>
                <td class="lg:tw-text-lg tw-w-2/6 lg:tw-w-1/6">Tujuan</td>
                <td class="lg:tw-text-lg tw-w-5/6">: {{ $reservation->destination }}</td>
              </tr>
              <tr>
                <td class="lg:tw-text-lg tw-w-2/6 lg:tw-w-1/6">Tanggal Mulai</td>
                <td class="lg:tw-text-lg tw-w-5/6">: {{ $reservation->start_date }}</td>
              </tr>
              <tr>
                <td class="lg:tw-text-lg tw-w-2/6 lg:tw-w-1/6">Tanggal Selesai</td>
                <td class="lg:tw-text-lg tw-w-5/6">: {{ $reservation->end_date }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="tw-flex tw-mb-2">
          <div class="tw-w-1/2 tw-mr-1">
            <button
              class="tw-w-full btn tw-text-white
              {{ $reservation->status == "Approved" ? "btn-primary": ""}}
              {{ $reservation->status == "Pending" ? "btn-warning": ""}}
              {{ $reservation->status == "Rejected" ? "btn-danger": ""}}
              "
              type="button"
              data-bs-toggle="modal"
              data-bs-target="#finishBackdrop"

              >
              {{ $reservation->status }}
            </button>
          </div>
          <div class="tw-w-1/2 tw-ml-1">

            @if(auth()->user()->load('role')->role->role_name === "Admin")
            <a href="{{ route('reservations.pages.edit', $reservation) }}" class="btn btn-success tw-w-full">Edit Pemesanan</a>
            @else
            @if($reservation->approvals->firstWhere('approver_id', auth()->user()->user_id))
            <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="btn tw-w-full btn-primary">Persetujuan</button>
            @else
            <button type="button" class="btn tw-w-full btn tw-text-gray-400 tw-border-gray-400">Persetujuan</button>
            @endif

            @endif
          </div>
        </div>
        <div class="tw-w-full tw-mt-4 tw-mb-2">
          <h1 class="tw-text-lg lg:tw-text-2xl">Pihak Penyetuju</h1>
        </div>
        <div class="tw-w-full tw-h-[1px] tw-bg-secondary tw-mb-2"></div>
        <div>
          <table class="tw-w-full">
            <thead>
              <tr class="tw-border tw-border-secondary tw-bg-secondary ">
                <th class="tw-py-2 tw-text-white tw-text-center">No</th>
                <th class="tw-py-2 tw-text-white">Nama Pihak Penyetuju</th>
                <th class="tw-py-2 tw-text-white tw-text-center">Status</th>
                <th class="tw-py-2 tw-text-white">Waktu Aksi</th>
                <th class="tw-py-2 tw-text-white">Komen</th>
              </tr>
            </thead>
            <tbody>
              @foreach($reservation->approvals as $approval)
              <tr class="tw-border tw-border-secondary">
                <td class="tw-py-2 tw-text-center">{{ $loop->iteration }}</td>
                <td class="tw-py-2">{{ $approval->approver->fullname }}</td>
                <td class="tw-py-2 tw-text-center">
                  <span class="tw-py-2 tw-px-2 tw-rounded-md tw-text-white
                  {{ $approval->status == "Approved" ? "tw-bg-blue-500" : "" }}
                  {{ $approval->status == "Pending" ? "tw-bg-yellow-500" : "" }}
                  {{ $approval->status == "Rejected" ? "tw-bg-red-500" : "" }}
                  ">
                    {{ $approval->status }}
                  </span>
                </td>
                <td class="tw-py-2">{{ $approval->updated_at }}</td>
                <td class="tw-py-2">{{ $approval->comments }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="">
    </div>
    @if(auth()->user()->load('role')->role->role_name === "Approver" && $reservation->approvals->firstWhere('approver_id', auth()->user()->user_id))
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Persetujuan</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="{{ route('approvals.request.update', $reservation) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="tw-mb-3">
                <label for="status" class="tw-block tw-mb-1 lg:tw-text-lg">Status</label>
                <select name="status" id="status" class="tw-w-full tw-border tw-border-secondary tw-rounded-md" required>
                  <option value="{{ $reservation->approvals->firstWhere('approver_id', auth()->user()->user_id)->status }}" class="tw-hidden">{{ $reservation->approvals->firstWhere('approver_id', auth()->user()->user_id)->status }}</option>
                  <option value="Approved">Approved</option>
                  <option value="Rejected">Rejected</option>
                  <option value="Pending">Pending</option>
                </select>
              </div>
              <div class="tw-mb-3">
                <label for="comments" class="tw-block tw-mb-1 lg:tw-text-lg">Komen</label>
                <textarea name="comments" id="comments" rows="5" class="tw-resize-none tw-w-full tw-rounded-md tw-border tw-border-secondary">{{ $reservation->approvals->firstWhere('approver_id', auth()->user()->user_id)->comments }}</textarea>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Perbarui</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    @endif
  </div>
</x-app-layout>
