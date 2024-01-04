@extends('layouts.app')

@section('content')

<section>
  <div class="container">
    <div class="form-card">
      <h1 class="fw-bold text-center mb-5">{{ __('dog.title') }}</h1>

      <div class="row justify-content-center">
        <div class="col-md-5">
          <form id="formDog" method="POST" action="{{ route('dogs.store') }}" enctype="multipart/form-data">
            @csrf
            @include('dogs.partials.form')
          </form>
        </div>
      </div>
  </div>
</section>

@endsection

@section('scripts')
  @include('dogs.partials.js')
@endsection
