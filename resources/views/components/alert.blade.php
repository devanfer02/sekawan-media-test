@if(session('failed'))
<div class="tw-mb-2 tw-bg-red-200 tw-border tw-border-red-500  tw-rounded-md alert alert-warning alert-dismissible fade show" role="alert">
  <span class="tw-text-red-500">{{ session('failed') }}</span>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

