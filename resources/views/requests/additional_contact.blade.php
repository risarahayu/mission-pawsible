@extends('layouts.app')

@section('content')
  <div class="container">
    @include('requests.partials.additional_contact', ['stray_dog' => $stray_dog, 'users' => $users, 'with_potential' => false])
  </div>

  <div class="d-flex justify-content-center">
    <a href="{{ route('requests.show', [$stray_dog]) }}" class="btn btn-custom-submit mt-3 m-auto">{{ __('app.button.see_dog_details') }}</a>
  </div>
@endsection
