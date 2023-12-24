<nav class="navbar navbar-expand-md navbar-light navbar-base shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">
      <img class="img-fluid" src="{{ asset('images/mp-logo.png') }}" alt="Mission Pawsible Logo">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Left Side Of Navbar -->
      <ul class="navbar-nav me-auto">
      </ul>

      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ms-auto">

        <!-- Authentication Links -->
        @guest

          <!-- Sepertinya tidak digunakan -->
          @if (Route::has('login'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
          @endif

          @if (Route::has('register'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
          @endif

        @else

          <!-- Route untuk rescuer atau adopter -->
          <li class="nav-item">
            @if (session('role') == 'rescuer')
              <a class="nav-link" href="{{ route('requests.create') }}"><i class="fa-solid fa-circle-plus"></i>New Request</a>
            @else
              <a class="nav-link" href="{{ route('dogs.create') }}"><i class="fa-solid fa-circle-plus"></i>Resgiter Dog</a>
            @endif
          </li>

          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link {{ request()->routeIs('user_contacts.create') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              <i class="bi bi-person-circle"></i>
              Settings
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#personal_information">
                {{ __('My Contact') }}
              </a>
              @if (session('role') == 'rescuer')
                <a class="dropdown-item" href="{{ route('role.set', ['role' => 'adopter']) }}">
                  {{ __('Change to adopter') }}
                </a>
              @else
                <a class="dropdown-item" href="{{ route('role.set', ['role' => 'rescuer']) }}">
                  {{ __('Change to rescuer') }}
                </a>
              @endif
              <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </div>
          </li>

        @endguest
      </ul>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="personal_information" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="personal_information_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <h1 class="modal-title fs-5" id="personal_information_label">Personal Information</h1>
          {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
        </div>
        <div class="modal-body">
          <form method="POST" action="{{-- route('dogs.update', $dog->id) --}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" style="min-width: 100px" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" style="min-width: 100px">Save</button>
        </div>
      </div>
    </div>
  </div>
</nav>
