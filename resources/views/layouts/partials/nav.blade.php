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
              <a class="nav-link" href="{{ route('requests.create') }}"><i class="fa-solid fa-circle-plus"></i>{{ __('nav.request') }}</a>
            @else
              <a class="nav-link" href="{{ route('dogs.create') }}"><i class="fa-solid fa-circle-plus"></i>{{ __('nav.register') }}</a>
            @endif
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ route('dogs.index') }}">{{ __('nav.dog_list') }}</a>
          <li>

          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link {{ request()->routeIs('user_contacts.create') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              <i class="bi bi-person-circle"></i>
              {{Auth::user()->first_name}}
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              @include('layouts.partials.lang')
              <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#personal_information">
                <i class="bi bi-person-lines-fill px-2"></i> {{ __('nav.contact') }}
              </a>
              <a class="dropdown-item border-bottom" href="{{ route('my_dog') }}">
                <i class="fa-solid fa-dog px-2"></i>{{ __('nav.my_dog') }}
              </a>
              @if (session('role') == 'rescuer')
                <a class="dropdown-item" href="{{ route('role.set', ['role' => 'adopter']) }}">
                  <i class="bi bi-arrow-repeat px-2"></i>{{ __('nav.adopter') }}
                </a>
              @else
                <a class="dropdown-item" href="{{ route('role.set', ['role' => 'rescuer']) }}">
                  <i class="fa-solid fa-repeat px-2"></i></i> {{ __('nav.rescuer') }}
                </a>
              @endif
              <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-right-from-bracket px-2"></i>{{ __('Logout') }}
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
        <form method="POST" action="{{ route('users.update', auth()->user()->id) }}" enctype="multipart/form-data">
          <div class="modal-body">
            @csrf
            @method('PUT')

            <div class="row row-cols-2">
              <div class="col">
                <div class="form-floating mb-3">
                  <input id="first_name" type="text" name="first_name"
                          class="form-control required @error('first_name') is-invalid @enderror"
                          autocomplete="first_name" placeholder="{{ __('first_name') }}"
                          value="{{ auth()->user()->first_name }}"
                          required>
                  <label for="first_name">{{ __('first_name') }}</label>
                  @error('first_name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="col">
                <div class="form-floating mb-3">
                  <input id="last_name" type="text" name="last_name"
                          class="form-control required @error('last_name') is-invalid @enderror"
                          autocomplete="last_name" placeholder="{{ __('last_name') }}"
                          value="{{ auth()->user()->last_name }}"
                          required>
                  <label for="last_name">{{ __('last_name') }}</label>
                  @error('last_name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
            </div>

            <div class="form-floating mb-3">
              <input id="birthday" type="date" name="birthday"
                      class="form-control @error('birthday') is-invalid @enderror"
                      autocomplete="birthday" placeholder="{{ __('birthday') }}"
                      value="{{ optional(auth()->user()->userInfo)->birthday }}">
              <label for="birthday">{{ __('birthday') }}</label>
              @error('birthday')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="form-floating mb-3">
              <input id="whatsapp" type="text" name="whatsapp"
                      class="form-control @error('whatsapp') is-invalid @enderror"
                      autocomplete="whatsapp" placeholder="{{ __('whatsapp') }}"
                      value="{{ optional(auth()->user()->userInfo)->whatsapp }}">
              <label for="whatsapp">{{ __('whatsapp') }}</label>
              @error('whatsapp')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="form-floating mb-3">
              <input id="facebook" type="text" name="facebook"
                      class="form-control @error('facebook') is-invalid @enderror"
                      autocomplete="facebook" placeholder="{{ __('facebook') }}"
                      value="{{ optional(auth()->user()->userInfo)->facebook }}">
              <label for="facebook">{{ __('facebook') }}</label>
              @error('facebook')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="form-floating mb-3">
              <input id="instagram" type="text" name="instagram"
                      class="form-control @error('instagram') is-invalid @enderror"
                      autocomplete="instagram" placeholder="{{ __('instagram') }}"
                      value="{{ optional(auth()->user()->userInfo)->instagram }}">
              <label for="instagram">{{ __('instagram') }}</label>
              @error('instagram')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="form-floating mb-3">
              <input id="street_address" type="text" name="street_address"
                      class="form-control @error('street_address') is-invalid @enderror"
                      autocomplete="street_address" placeholder="{{ __('street_address') }}"
                      value="{{ optional(auth()->user()->userInfo)->street_address }}">
              <label for="street_address">{{ __('street_address') }}</label>
              @error('street_address')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="row row-cols-2">
              <div class="col">
                <div class="form-floating mb-3">
                  <input id="city" type="text" name="city"
                          class="form-control @error('city') is-invalid @enderror"
                          autocomplete="city" placeholder="{{ __('city') }}"
                          value="{{ optional(auth()->user()->userInfo)->city }}">
                  <label for="city">{{ __('city') }}</label>
                  @error('city')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="col">
                <div class="form-floating mb-3">
                  <input id="province" type="text" name="province"
                          class="form-control @error('province') is-invalid @enderror"
                          autocomplete="province" placeholder="{{ __('province') }}"
                          value="{{ optional(auth()->user()->userInfo)->province }}">
                  <label for="province">{{ __('province') }}</label>
                  @error('province')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="col">
                <div class="form-floating mb-3">
                  <input id="postal" type="text" name="postal" pattern="\d*" maxlength="8"
                          class="form-control @error('postal') is-invalid @enderror"
                          autocomplete="postal" placeholder="{{ __('postal') }}"
                          value="{{ optional(auth()->user()->userInfo)->postal }}">
                  <label for="postal">{{ __('postal') }}</label>
                  @error('postal')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" style="min-width: 100px" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" style="min-width: 100px">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</nav>
