@extends('layouts.app')

@section('content')

      <div class="container">
      <img class="step-image" src="{{asset('images/step/step 2.svg')}}" alt="">
      <div class="text-center m-auto my-2 text-base-color">
        <p class="fs-4 m-0">{{ __('app.step.second') }}</p>
        <p class="alert alert-info m-auto mb-3">{{ __('app.view_contact.alert') }}</p>
      </div>
      <!-- <p class="fs-4"> </p> -->
      <form method="POST" action="{{ route('dogs.update_contact', [$user->id, $data->id]) }}" enctype="multipart/form-data">
        <div class="modal-body">
          @csrf
          @method('PUT')

          <div class="form-card">
            <h1 class="fw-bold text-center mb-2">{{ __('app.view_contact.title') }}</h1>
          </div>

          <div class="form-card">
            @include('auth.partials.form_contact')

            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-secondary" style="min-width: 100px" data-bs-dismiss="modal">Close</button> -->
              <button type="submit" class="btn btn-primary" style="min-width: 100px">{{ __('app.button.save') }}</button>
            </div>
          </div>
        </div>
      </form>
    </div>

@endsection
