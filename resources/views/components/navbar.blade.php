<nav class="navbar navbar-expand-lg tw-bg-primary tw-px-2 lg:tw-px-10 tw-py-3">
  <div class="container-fluid">
    <a class="navbar-brand tw-font-bold" href="#">Sekawan Media</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <x-navlink route="dashboard" href="{{ route('dashboard') }}" name="Dashboard"/>
        <x-navlink route="vehicles*" href="{{ route('vehicles.pages.index') }}" name="Kendaraan"/>
        <x-navlink route="reservations*" href="{{ route('reservations.pages.index') }}" name="Pemesanan"/>
        <x-navlink route="logs*" href="{{ route('logs.pages.index') }}" name="Log Aplikasi"/>

        <div class="tw-block lg:tw-hidden">
          <li class="nav-item">
            <a class="nav-link" href="#">Admin 1</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Logout</a>
          </li>
        </div>
      </ul>
      <div class="lg:tw-flex tw-justify-end navbar-nav tw-hidden">
        <li class="nav-item">
          <a class="nav-link" href="#">Admin 1</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="#">Logout</a>
        </li>
      </div>
    </div>
  </div>
</nav>
