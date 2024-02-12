@extends('layouts.app')

@section('content')

<section>
  <div class="container">
    <img class="step-image" src="{{asset('images/step/step 1.svg')}}" alt="">
    <div class="text-center m-auto my-2 text-base-color">
      <p class="fs-4 m-0">{{ __('app.step.first') }}</p>
      <p class="alert alert-info m-auto mb-3">{{ __('rescue.create.alert') }}</p>
    </div>
    <div class="form-card">
      <h1 class="fw-bold text-center mb-5">{{ __('dog.title') }}</h1>
      @if($controller_name == 'dog')
        <div class="alert text-center alert-info m-auto mb-5" role="alert">
          {!! __('dog.alert') !!}
        </div>
      @endif
      <div class=" row justify-content-center">
        <div class="col-md-5">
          <form id="formDog" method="POST" action="{{ route('requests.store') }}" enctype="multipart/form-data">
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
