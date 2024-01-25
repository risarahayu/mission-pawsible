@extends('layouts.auth')

@section('content')
  <div class="container">
    <div class="row row-cols-1 row-cols-lg-2">

      {{-- BIG LOGO IMAGE --}}
      <div class="col">
        <img class="img-fluid" src="{{ url('/images/mp_logo_big.svg') }}" alt="Image" />
      </div>
      {{-- End of big logo image --}}

      {{-- Login Form --}}
      <div class="col d-flex align-items-center">
        <div class="px-5">
          <h2 class="text-center mb-4 fw-bold">{{ __('session.title') }}</h2>
          <form method="POST" action="{{ route('login') }}" class="mx-lg-5 px-lg-5">
            @csrf

            {{-- Email Input --}}
            <div class="mb-3">
              <label class="fw-bold mb-1" for="email">{{ __('session.email_address') }}</label>
              <input id="email" placeholder="{{ __('session.placeholder.email') }}" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autocomplete="email" autofocus>
              @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            {{-- End of email input --}}
  
            {{-- Password input --}}
            <div class="mb-5">
              <label class="fw-bold mb-1" for="password">{{ __('session.password') }}</label>
              <input id="password" placeholder="{{ __('session.placeholder.password') }}" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="current-password">
              @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            {{-- End of password input --}}
  
            {{-- Buttons --}}
            <div class="d-flex mb-5 flex-column">
              <button type="submit" class="btn btn-auth w-100">
                {{ __('session.login') }}
              </button>
              <a href="{{ route('register') }}" class="btn btn-empty w-100">
                {{ __('session.create_account') }}
              </a>
            </div>
            {{-- End of buttons --}}

          </form>
        </div>
      </div>
      {{-- End of login form --}}

    </div>
  </div>

  <!-- <script type="module">
    $(function() {
      $('.btn-empty').mouseenter(function() { $('.btn-auth').css('color', '#fff') })
      $('.btn-empty').mouseleave(function() { $('.btn-auth').css('color', '#BD1A8D') })
    })
  </script> -->
@endsection
