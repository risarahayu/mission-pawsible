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
              <a class="nav-link" href="{{ route('requests.create') }}">
                <img class="dtl-icon" src="{{ asset('images/paw.svg') }}">
                Rescues
              </a>
            @else
              <a class="nav-link" href="{{ route('dogs.create') }}">
                <img class="dtl-icon" src="{{ asset('images/paw.svg') }}">
                Adoption
              </a>
            @endif
          </li>

          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link {{ request()->routeIs('user_contacts.create') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              <i class="bi bi-person-circle"></i>
              Settings
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">
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
</nav>
