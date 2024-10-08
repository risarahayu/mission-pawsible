@extends('layouts.app')

@section('content')
  <!-- Dog information -->
  <section id="dog_information">
    <div class="container">
      <!-- Dog information title -->
      <div class="main-card text-center">
        <h3 class="fw-bold m-1">{{ __('dog.show.title') }}</h3>
      </div>

      <!-- Dog information detail -->
      <div class="row flex-lg-row flex-column-reverse">
        <div class="col-lg-6 dog-show">
          <div class="main-card">
            <!-- Action button -->
            <div class="d-flex justify-content-end" style="gap: 5px;">
              @if(Auth::id()==$stray_dog->user_id)
                <a type="button" class="btn btn-mps" href="{{ route('requests.edit', $stray_dog->id) }}"><i class="bi bi-pencil-square me-2"></i> {{ __('app.button.edit') }}</a>
                @if (!$stray_dog->rescued)
                  <form action="{{ route('requests.destroy', $stray_dog->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger delete-dog need-confirm">
                      <i class="bi bi-trash me-2"></i> Delete
                    </button>
                  </form>
                @endif
              @endif
            </div>

            <!-- Dog details -->
            @include('dogs.partials.dog_detail')
          </div>
        </div>

        <div class="col-lg-6 text-center position-relative">
          <!-- Dog picture carousel -->
          @include('dogs.partials.dog_carousel', ['carousel_type' => 'requester'])
        </div>
      </div>
    </div>
  </section>

  <div class="section mt-5">
    <div class="container">
      @include('requests.partials.additional_contact', ['stray_dog' => $stray_dog, 'users' => $users])
    </div>
  </div>
@endsection
