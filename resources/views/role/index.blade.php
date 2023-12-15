@extends('layouts.auth')

@section('content')
  <div class="container text-center role">

    {{-- Logo mission pawsible --}}
    <div class="w-100 d-flex justify-content-center">
      <div class="logo-wrapper text-center">
        <img class="img-fluid" src="{{ url('/images/mp_logo_big.svg') }}" alt="Image" />
      </div>
    </div>

    {{-- List button role --}}
    <h1 class="display-6 text-white p-5 fw-bold">{{ __('role.title') }}</h1>
    <div class="role-list">
      <a href="{{ route('role.set', ['role' => 'rescuer']) }}" class="btn btn-role">
        <i class="fa-solid fa-kit-medical"></i>{{ __('role.rescue') }}
      </a>
      <a href="{{ route('role.set', ['role' => 'adopter']) }}" class="btn btn-role">
        <i class="fa-solid fa-hand-holding-heart"></i>{{ __('role.adopt') }}
      </a>
    </div>

  </div>
@endsection
