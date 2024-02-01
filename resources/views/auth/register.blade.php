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

            @include('auth.partials.form')

            {{-- Buttons --}}
            <div class="d-flex mb-5 flex-column">
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
