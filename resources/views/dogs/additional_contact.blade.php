@extends('layouts.app')

@section('content')
  <!-- ADOPTER DETAIL HERE -->
  @include('dogs.partials.adopter_detail')

  <div class="d-flex justify-content-center">
    <a href="{{ route('dog.my_dog.list') }}" class="btn btn-custom-submit mt-3 m-auto">{{ __('app.button.see_all_my_dog') }}</a>
  </div>
@endsection
