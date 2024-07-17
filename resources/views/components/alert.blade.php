@if(session('failed'))
<div class="tw-mb-2 tw-bg-red-200 tw-border tw-border-red-500  tw-rounded-md alert alert-warning alert-dismissible fade show" role="alert">
  <span class="tw-text-red-500">{{ session('failed') }}</span>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@elseif(session('success'))
<div class="tw-mb-2 tw-bg-green-200 tw-border tw-border-green-500  tw-rounded-md alert alert-warning alert-dismissible fade show" role="alert">
  <span class="tw-text-green-500">{{ session('success') }}</span>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif


