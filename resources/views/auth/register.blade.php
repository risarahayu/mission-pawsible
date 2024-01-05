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
          <h2 class="text-center mb-4 fw-bold">{{ __('session.title') }}</h2>
          <form method="POST" action="{{ route('register') }}" class="mx-xl-5 px-xl-5">
            @csrf

            {{-- Name input --}}
            <div class="mb-3">
              <div class="row row-cols-lg-2">
                <div class="col">
                  <label class="fw-bold mb-1" for="name">{{ __('session.first_name') }}</label>
                  <input placeholder="{{ __('session.placeholder.first_name') }}" id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                    value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
                  @error('first_name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="col">
                  <label class="fw-bold mb-1" for="name">{{ __('session.last_name') }}</label>
                  <input placeholder="{{ __('session.placeholder.last_name') }}" id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                    value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>
                  @error('last_name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
            </div>
            {{-- End of name input --}}

            {{-- Email input --}}
            <div class="mb-3">
              <label class="fw-bold mb-1" for="email">{{ __('session.email_address') }}</label>
              <input id="email" placeholder="{{ __('session.placeholder.email') }}" type="email" class="form-control @error('email') is-invalid @enderror"
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
              <label class="fw-bold mb-1" for="password">{{ __('session.password') }}</label>
              <input id="password" placeholder="{{ __('session.placeholder.password') }}" type="password" class="form-control @error('password') is-invalid @enderror"
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
              <label class="fw-bold mb-1" for="password-confirm">{{ __('session.confirm_password') }}</label>
              <input id="password-confirm" placeholder="{{ __('session.placeholder.confirm_password') }}" type="password" class="form-control" name="password_confirmation" required
                autocomplete="new-password">
            </div>
            {{-- End of password confirm input --}}

            {{-- Buttons --}}
            <div class="d-flex mb-5 flex-column flex-lg-row">
              <button type="submit" class="btn btn-auth w-100">
                {{ __('session.register') }}
              </button>
              <a href="{{ route('login') }}" class="btn btn-empty w-100">
                {{ __('session.already_have_account') }}
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
