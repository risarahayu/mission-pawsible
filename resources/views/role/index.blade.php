@extends('layouts.auth')

@section('content')
  <div class="container text-center role">

    {{-- Logo mission pawsible --}}
    <!-- <div class="w-100 d-flex justify-content-center">
      <div class="logo-wrapper text-center">
        <img class="img-fluid" src="{{ url('/images/mp_logo_big.svg') }}" alt="Image" />
      </div>
    </div> -->

    {{-- List button role --}}
    <h3 class="fs-4 text-white pb-5  text-start">{{ __('role.title') }}</h3>
    <div class="role-list flex-column ">
      <a href="{{ route('role.set', ['role' => 'adopter']) }}" class="btn btn-role">
        {{ __('role.option_1') }}<i class="bi bi-arrow-right-short"></i>
      </a>
      <a href="{{ route('role.set', ['role' => 'adopter', 'create' => true]) }}" class="btn btn-role">
        {{ __('role.option_2') }}<i class="bi bi-arrow-right-short"></i>
      </a>
      <a href="{{ route('role.set', ['role' => 'rescuer']) }}" class="btn btn-role">
        {{ __('role.option_3') }}<i class="bi bi-arrow-right-short"></i>
      </a>

    </div>

  </div>
@endsection
