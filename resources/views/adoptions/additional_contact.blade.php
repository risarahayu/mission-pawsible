@extends('layouts.app')

@section('content')
  <div class="container">
    <img class="step-image" src="{{asset('images/step/step 3.svg')}}" alt="">
    <div class="text-center m-auto my-2 text-base-color">
      <p class="fs-4 m-0">{{ __('app.status.waiting_for_approval') }}</p>
      <p class="alert alert-info m-auto mb-3">{{ __('adoption.additional_contact.alert') }}</p>
    </div>

    <div class="dog-card">
      <div class="brief">
        <div class="wrapper">
          @include('dogs.partials.adopters_card', ['user' => $adoption->dog->user])
        </div>
      </div>
    </div>
    <div class="d-flex justify-content-center">
      <a href="{{ route('dog.my_dog.adoption_request') }}" class="btn btn-custom-submit mt-3 m-auto"> {{ __('app.button.see_all_request') }}</a>
    </div>
  </div>
@endsection
