<x-guest-layout>
  <div class="tw-bg-primary tw-h-full">
    <div class="tw-flex tw-justify-center tw-items-center tw-h-full">
      <div class="tw-border tw-border-secondary tw-bg-white tw-rounded-lg tw-pt-10 tw-pb-20 tw-px-16 tw-w-[500px]">
        <div>
          <div class="tw-flex tw-justify-center tw-items-center">
            <iconify-icon icon="mdi:laravel" width="5em" height="5em" class="tw-text-secondary"></iconify-icon>
          </div>
          <h1 class="tw-text-3xl tw-font-semibold tw-text-start">
            Register
          </h1>
        </div>
        <div class="tw-h-[1px] tw-bg-secondary tw-mb-5"></div>
        <form action="{{ route('auth.request.register') }}" method="POST">
          @csrf
          <x-input
            type="fullname"
            name="Fullname"
            id="fullname"
            required
          />
          <x-input
            type="email"
            name="Email"
            id="email"
            required
          />
          <x-input
            type="password"
            name="Password"
            id="password"
            required
          />
          <x-input
            type="password"
            name="Confirm Password"
            id="password_confirmation"
            required
          />
          <div class="tw-mb-2">
            <button class="tw-w-full tw-border tw-border-secondary tw-bg-secondary tw-py-1.5 tw-px-2 tw-text-white tw-rounded-md hover:tw-bg-white hover:tw-text-secondary tw-duration-300 tw-ease-in-out" type="submit">
              Register
            </button>
          </div>
          <x-alert />
          <div >
            <span>Already have an account? <a href="{{route('auth.pages.login')}}" class="tw-underline tw-text-secondary">Login</a></span>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-guest-layout>
