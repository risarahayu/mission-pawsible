@extends('layouts.auth')

@section('content')
  <div class="container text-center">
    <h1 class="display-6 text-white p-5">Hi, What are you looking for?</h1>
    <div class="row">
      <div class="col">
        <a href="{{ route('role.set', ['role' => 'rescuer']) }}" class="btn btn-custom-role p-5">Rescue Dog</a>
      </div>
      <div class="col">
        <a href="{{ route('role.set', ['role' => 'adopter']) }}" class="btn btn-custom-role p-5">Adoption Dog</a>
      </div>
    </div>
  </div>
@endsection