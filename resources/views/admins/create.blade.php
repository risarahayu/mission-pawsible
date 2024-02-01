@extends('layouts.app')

@section('content')

<section>
  <div class="container">
    <div class="form-card">
      <h1 class="fw-bold text-center mb-5">{{ __('dog.title') }}</h1>
      <div class=" row justify-content-center">
        <div class="col-md-5">
          <form id="formDog" method="POST" action="{{ route('admins.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="role" value="rescuer">

            @include('auth.partials.form')

            <button type="submit" class="btn btn-custom-submit w-100">
              {{ __('dog.form.button.submit') }}
            </button>
          </form>
        </div>
      </div>
  </div>
</section>

@endsection
