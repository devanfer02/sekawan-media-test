<x-guest-layout>
  <div class="tw-bg-primary tw-h-full">
    <div class="tw-flex tw-justify-center tw-items-center tw-h-full">
      <div class="tw-border tw-border-secondary tw-bg-white tw-rounded-lg tw-py-20 tw-px-16 tw-w-[500px]">
        <div>
          <h1 class="tw-text-3xl tw-font-semibold tw-text-start">
            Login
          </h1>
        </div>
        <div class="tw-h-[1px] tw-bg-secondary tw-mb-5"></div>
        <form action="{{ route('auth.request.login') }}" method="POST">
          @csrf
          <x-input
            type="email"
            name="Email"
            id="email"
            value="{{old('email')}}"
          />
          <x-input
            type="password"
            name="Password"
            id="password"
            value="{{old('password')}}"
          />
          <div class="tw-mb-3 tw-flex tw-items-center">
            <input type="checkbox" class="tw-rounded-md" name="remember" id="remember">
            <label for="remember" class="tw-ml-2">Remember Me</label>
          </div>
          <div class="tw-mb-2">
            <button class="tw-w-full tw-border tw-border-secondary tw-bg-secondary tw-py-1.5 tw-px-2 tw-text-white tw-rounded-md hover:tw-bg-white hover:tw-text-secondary tw-duration-300 tw-ease-in-out" type="submit">
              Login
            </button>
          </div>
          <x-alert />
          <div >
            <span>Don't have an account? <a href="{{route('auth.pages.register')}}" class="tw-underline tw-text-secondary">Register</a></span>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-guest-layout>
