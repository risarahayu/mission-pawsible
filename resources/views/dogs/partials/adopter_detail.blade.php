<!-- Adoption infromation -->
@if(Auth::id() == $own->id)
  <section id="dog_adoption">
    <div class="container">
      @if(!$stray_dog->adopted)
        <img class="step-image pt-5" src="{{asset('images/step/step 3.svg')}}" alt="">
        @if($stray_dog->adoptions->count() == 0)
          <div class="text-center m-auto my-2 text-base-color fs-5 ">
            {{ __('app.step.waiting_adopter') }}
          </div>

          <p class="alert alert-info m-auto mb-3 text-center">
            <span class="fw-semibold">{{ __('dog.additional_contact.alert.title') }}</span><br>
            {!! __('dog.additional_contact.alert.content') !!}
          </p>
        @elseif($stray_dog->adoptions->count() > 0)
          <div class="text-center m-auto my-2 text-base-color fs-5 ">
            {{ __('app.step.adopter_selection') }}
          </div>

          <p class="alert alert-info m-auto mb-3 text-center">
            <span class="fw-semibold">{{ __('dog.adopter_detail.review_potential') }}</span><br>
            {{ __('dog.adopter_detail.review_profile') }}
          </p>
        @endif
      @else
        <img class="step-image pt-5" src="{{asset('images/step/step 3 finish.svg')}}" alt="">
        <div class="text-center m-auto my-2 text-base-color fs-5 ">
          {{ __('app.step.chat_adopter') }}
        </div>

        <p class="text-center">Please coordinate among yourselves for the pickup of the dog. Congratulations!</p>
        <div class="alert alert-info m-auto text-center" role="alert" style="width:75% !important;">
          {{ __('dog.adopter_detail.recommend_monitoring') }}
        </div>
      @endif


      @if ($adoptions->count() > 0)
        <!-- Dog information title -->
        <div class="main-card text-center mt-4">
          @if ($stray_dog->adopted)
            <h3>{{ __('dog.adopter_detail.new_adopter') }}</h3>
          @else
            <h3>{{ __('dog.adopter_detail.adopters') }}</h3>
            {{ __('dog.adopter_detail.found_adopter', ['count' => $stray_dog->adoptions->count()]) }}
          @endif

          <div class="alert m-auto d-flex justify-content-center border-top mt-3"  role="alert">
            <i class="bi bi-info-square-fill me-2 text-warning"></i>
            <p>{!! __('dog.adopter_detail.term') !!}</p>
          </div>
        </div>

        <!-- term modal -->
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><strong>{{ __('adoption.term_and_condition.title') }}</strong></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>
                  {{ __('adoption.term_and_condition.sub_title') }}
                </p>

                <ol>
                  <li>{{ __('adoption.term_and_condition.line_1') }}</li>
                  <li>{{ __('adoption.term_and_condition.line_2') }}</li>
                  <li>{{ __('adoption.term_and_condition.line_3') }}</li>
                  <li>{{ __('adoption.term_and_condition.line_4') }}</li>
                  <li>{{ __('adoption.term_and_condition.line_5') }}</li>
                  <li>{{ __('adoption.term_and_condition.line_6') }}</li>
                  <li>{{ __('adoption.term_and_condition.line_7') }}</li>
                </ol>

                <p>
                  {{ __('adoption.term_and_condition.end_line') }}
                </p>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          @if(!$stray_dog->adopted)
            @foreach ($adoptions as $adoption)
              <div class="col-md-4 pb-3">
                <!-- ADOPTIONS CARD HERE -->
                @include('dogs.partials.adopters_card', ['user' => $adoption->user])
                <!-- MODAL HERE -->
                @include('dogs.partials.modal_adopter', ['adoption' => $adoption])
              </div>
            @endforeach
          @else
            <div class="dog-card col-md-6 m-auto">
              <div class="brief">
                <div class="wrapper">
                  <!-- ADOPTER CARD HERE -->
                  @include('dogs.partials.adopters_card', ['user' => $own_new->user, 'adoption' => $own_new])

                  <!-- MODAL HERE -->
                  @include('dogs.partials.modal_adopter', ['adoption' => $own_new])
                </div>
              </div>
            </div>
          @endif
        </div>
      @else
        <div class="dashboard-nodata-card dogs">
          <div class="d-flex flex-column align-items-center">
            <img src="{{ asset('images/single-dog.png') }}" alt="Single Dog" width="6rem">
            <p class="m-0 mt-2 txt-1">{{ __('dog.additional_contact.no_adopter') }}</p>
          </div>
        </div>
      @endif
    </div>
  </section>
@endif
