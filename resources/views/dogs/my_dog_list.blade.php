@extends('layouts.app')

@section('content')
  <div class="container">
    <h3>Your Dog</h3>
    @include('dogs.partials.dog_list');
  </div>
@endsection