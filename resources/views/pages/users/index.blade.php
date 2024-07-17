<x-app-layout>
  <div class="container">
    <div class="tw-w-full tw-mb-5">
      <div class="tw-flex tw-justify-between tw-my-2">
        <h1 class="tw-text-3xl">List Pengguna</h1>
      </div>
      <x-alert />
      <div class="tw-w-full tw-h-[1px] tw-bg-secondary"></div>
    </div>
    <div class="tw-mb-5">
      <table class="tw-w-full">
        <thead>
          <tr class="tw-border tw-border-secondary tw-bg-secondary ">
            <th class="tw-py-2 tw-text-white tw-text-center">No</th>
            <th class="tw-py-2 tw-text-white">Nama Lengkap</th>
            <th class="tw-py-2 tw-text-white">Role</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
          <tr class="tw-border tw-border-secondary">
            <td class="tw-py-2 tw-text-center">{{ $loop->iteration }}</td>
            <td class="tw-py-2">{{ $user->fullname }}</td>
            <td class="tw-py-2">{{ $user->role->role_name }}</td>

          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div>
      {!! $users->links() !!}
    </div>
  </div>
</x-app-layout>
