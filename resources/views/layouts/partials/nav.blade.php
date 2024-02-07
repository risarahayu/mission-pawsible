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
      <ul class="navbar-nav ms-auto" style="gap: 10px;">

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
          @if (session('role') == 'admin')
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admins.index') }}"><i class="fa-solid fa-shield-dog"></i>{{ __('nav.solo_rescuer') }}</a>
            </li>
          @else
            @if(session('role') == 'adopter')
              <!-- Route untuk rescuer atau adopter -->
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}"><img src="{{asset('images/explore_dog.svg')}}" width="30px" class="img-fluid" alt="">{{ __('nav.explore') }}</a>
              </li>
            @endif
              <!-- my dog dropdown -->
            <li class="nav-item dropdown">
              <!-- <a class="nav-link" href="{{ route('dog.my_dog') }}"> -->
              <a id="navbarDropdown" class="nav-link {{ request()->routeIs('dog.my_dog') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                <i class="fa-solid fa-dog px-2"></i>{{ __('nav.my_dog') }}<i class="bi bi-caret-down-fill"></i>
              </a>
              <div class="dropdown-menu p-3 dropdown-menu-end row" aria-labelledby="navbarDropdown">
                @if (session('role') == 'adopter')
                <div class="card dropdown-item mb-3">
                    <div class="card-body">
                      <h5 class="card-title">{{ __('nav.my_adoption_requests.title') }}</h5>
                      <p class="card-text">{{ __('nav.my_adoption_requests.sub_title') }}</p>
                      <a class="btn btn-primary" href="{{ route('dog.my_dog.adoption_request') }}">{{ __('app.button.see_detail') }}</a>
                    </div>
                  </div>
                @endif

                  <div class="card dropdown-item">
                    <div class="card-body">
                      <h5 class="card-title">{{ __('nav.my_dog_listing.title') }}</h5>
                      @if(session('role') == 'adopter')
                        <p class="card-text">{{ __('nav.my_dog_listing.adopter') }}</p>
                        <a class="btn btn-primary" href="{{ route('dog.my_dog.list') }}">{{ __('app.button.see_detail') }}</a>
                      @else
                        <p class="card-text">{{ __('nav.my_dog_listing.rescuer') }}</p>
                        <a class="btn btn-primary" href="{{ route('requests.my_dog.list') }}">{{ __('app.button.see_detail') }}</a>
                      @endif
                    </div>
                </div>

            </li>


          @endif

          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link {{ request()->routeIs('user_contacts.create') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              <i class="bi bi-person-circle"></i>
              {{Auth::user()->first_name}}<i class="bi bi-caret-down-fill"></i>
            </a>

            <div class="dropdown-menu dropdown-menu-end p-2" aria-labelledby="navbarDropdown">
              @include('layouts.partials.lang')
              @if(session('role')=='adopter'|| session('role') =='rescuer')
                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#personal_information">
                  <i class="bi bi-person-lines-fill px-2"></i> {{ __('nav.contact') }}
                </a>
              @endif
              <a class="dropdown-item  border-bottom pb-3" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-right-from-bracket px-2"></i>{{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>

              @if (session('role') == 'rescuer')
                <div class="card dropdown-item my-3">
                  <div class="card-body">
                    <h5 class="card-title">{{ __('nav.adopter.title') }}</h5>
                    <p class="card-text">{!! __('nav.adopter.sub_title') !!}</p>
                    <a class="btn btn-primary" href="{{ route('role.set', ['role' => 'adopter']) }}">{{ __('app.button.change_role') }}</a>
                  </div>
                </div>
              @elseif (session('role') == 'adopter')
                <div class="card dropdown-item my-3">
                  <div class="card-body">
                    <h5 class="card-title">{{ __('nav.rescuer.title') }}</h5>
                    <p class="card-text">{!! __('nav.rescuer.sub_title') !!}</p>
                    <a class="btn btn-primary" href="{{ route('role.set', ['role' => 'rescuer']) }}">{{ __('app.button.change_role') }}</a>
                  </div>
                </div>
              @endif
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

            @include('auth.partials.form_contact')
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
