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
              @if(Auth::id()==$stray_dog->user_id && !$stray_dog->adopted)
                <a type="button" class="btn btn-mps" href="{{ route('dogs.edit', $stray_dog->id) }}"><i class="bi bi-pencil-square me-2"></i> {{ __('app.button.edit') }}</a>
                @if (!$stray_dog->adopted)
                  <form action="{{ route('dogs.destroy', $stray_dog->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger need-confirm">
                      <i class="bi bi-trash me-2"></i> {{ __('app.button.delete') }}
                    </button>
                  </form>
                @endif
              @elseif(session('role')=='adopter')
                @if (!$stray_dog->adopted && $user->adoptions->where('dog_id', $stray_dog->id)->isEmpty())
                  <a type="button" class="btn btn-mps" href="{{ route('adoptions.create', ['dog' => $stray_dog->id]) }}">
                    <i class="fa-solid fa-hand-holding-heart me-2"  ></i> {{ __('app.button.adopt') }}
                  </a>
                @endif
              @endif
            </div>

            <!-- Dog details -->
            @include('dogs.partials.dog_detail')
          </div>

          <!-- Adoption button -->
          <div class="text-center w-100">
            @if($user->id != $own->id)
              @if($stray_dog->adopted)
                @if($user->id == $own_new->user_id)
                  <p class="fs-2 alert alert-success">{{ __('dog.show.got_it') }}</p>
                @else
                  <p class="fs-2">{{ __('dog.show.already_adopted') }}</p>
                @endif
              @elseif(!$stray_dog->adopted && $userAdoption)
                <p class="fs-2">{{ __('dog.show.keep_update') }}</p>
                <div class="text-base-color-background btn-primary fw-bold fs-5">{{ __('dog.show.already_request') }}</div>
                <p class="fs-6 mt-3 alert alert-warning">{{ __('dog.show.waiting_approval') }}</p>
              @endif
            @endif
          </div>
        </div>

        <div class="col-lg-6 text-center position-relative">
          <!-- Dog picture carousel -->
          @include('dogs.partials.dog_carousel', ['carousel_type' => 'dog'])
        </div>
      </div>
    </div>
  </section>

  <!-- ADOPTER DETAIL HERE -->
  @include('dogs.partials.adopter_detail')
@endsection
