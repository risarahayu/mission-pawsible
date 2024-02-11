@extends('layouts.app')

@section('content')
  <div class="container">
    <h3>{{ __('dog.your_dog') }}</h3>
    @include('dogs.partials.dog_list')
  </div>
@endsection
