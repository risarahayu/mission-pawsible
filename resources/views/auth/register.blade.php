@extends('layouts.auth')

@section('content')
  <div class="container">
    <div class="row row-cols-1 row-cols-lg-2">

      {{-- BIG LOGO IMAGE --}}
      <div class="col">
        <img class="img-fluid" src="{{ url('/images/mp_logo_big.svg') }}" alt="Image" />
      </div>
      {{-- End of big logo image --}}

      {{-- Register Form --}}
      <div class="col d-flex align-items-center">
        <div class="px-5">
          <h2 class="text-center mb-4 fw-bold">EVERY RESCUE MISSION IS POSSIBLE WHERE WE WORK TOGETHER!</h2>
          <form method="POST" action="{{ route('register') }}" class="mx-xl-5 px-xl-5">
            @csrf

            {{-- Name input --}}
            <div class="mb-3">
              <label for="name">{{ __('Name') }}</label>
              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                value="{{ old('name') }}" required autocomplete="name" autofocus>
              @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            {{-- End of name input --}}

            {{-- Email input --}}
            <div class="mb-3">
              <label for="email">{{ __('Email Address') }}</label>
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                name="email" value="{{ old('email') }}" required autocomplete="email">
              @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            {{-- End of email input --}}

            {{-- Password input --}}
            <div class="mb-3">
              <label for="password">{{ __('Password') }}</label>
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="new-password">
              @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            {{-- End of password input --}}

            {{-- Password confirm input --}}
            <div class="mb-5">
              <label for="password-confirm">{{ __('Confirm Password') }}</label>
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                autocomplete="new-password">
            </div>
            {{-- End of password confirm input --}}

            {{-- Buttons --}}
            <div class="d-flex mb-5 flex-column flex-lg-row">
              <button type="submit" class="btn btn-auth w-100">
                {{ __('Register') }}
              </button>
              <a href="{{ route('login') }}" class="btn btn-empty w-100">
                {{ __('Already have account') }}
              </a>
            </div>
            {{-- End of buttons --}}

          </form>
        </div>
      </div>
      {{-- End of register  form --}}

    </div>
  </div>
@endsection
