<div class="tw-mb-3">
  <label for="{{ $id }}" class="tw-block tw-mb-1 lg:tw-text-lg">{{ $name }} @if($required) <span class="tw-text-red-500">*</span> @endif </label>
  <input
    type="{{ $type }}"
    class="tw-py-2 tw-px-2 tw-w-full tw-rounded-md tw-border tw-border-secondary"
    id="{{ $id }}"
    name="{{ $id }}"
    value="{{ $value }}"
    placeholder="{{ $placeholder }}"
    @if($required) required @endif
  />
  @error($id)
  <span class="tw-text-red-500">{{ $message }}</span>
  @enderror
</div>
