<!-- MODAL -->
<div class="modal fade" id="rescuer_information_{{ $adoption->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="rescuer_information_{{ $adoption->id }}_label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <button type="button" class="btn-close pt-3 ps-3" aria-label="Close" data-bs-dismiss="modal"></button>

      <div class="modal-header justify-content-center">
        <h1 class="modal-title fs-5" id="rescuer_information_{{ $adoption->id }}_label">
          <i class="bi bi-person-circle me-2"></i>{{ $adoption->user->first_name . ' ' . $adoption->user->last_name }}
        </h1>
      </div>

      <div class="modal-header justify-content-center">
        <h1 class="modal-title fs-5" id="rescuer_information_{{ $adoption->id }}_label">
          @if($adoption->residency_duration == null)
            Indonesian
          @else
            Foreigner
          @endif
        </h1>
      </div>

      <div class="modal-body py-4 px-5">
        <div class="d-flex  align-items-start" style="gap: 10px">
          <i class="fa-solid fa-house"></i>
          <div class="d-flex flex-column">
            <div>
              <small>{{ __('dog.adopter_detail.housing_type.title') }}</small>
              <div class="mb-0 fw-normal d-flex" style="gap: 5px;">
                @if($adoption->housing_type == "compound" || $adoption->housing_type == "private_villa")
                  <i class='bi bi-check-circle-fill text-success'></i>
                @elseif($adoption->housing_type == "guesthouse")
                  <i class='bi bi-info-circle-fill text-warning'></i>
                @else
                  <i class='bi bi-x-circle-fill text-danger'></i>
                @endif

                {{ __("adoption.option.$adoption->housing_type") }}
              </div>

              @if($adoption->housing_type == "guesthouse")
                <div class="alert alert-warning" role="alert">
                  {{ __('dog.adopter_detail.housing_type.guesthouse') }}
                </div>
              @elseif($adoption->housing_type == "kos")
                <div class="alert alert-danger" role="alert">
                  {{ __('dog.adopter_detail.housing_type.kos') }}
                </div>
              @endif
            </div>

            <div class="pt-2">
              <small>{{ __('dog.adopter_detail.housing_condition.title') }}</small>
              <div class="mb-0 fw-normal d-flex" style="gap: 5px">
                @if($adoption->housing_condition)
                  <i class='bi bi-check-circle-fill text-success'></i>
                  {{ __('dog.adopter_detail.housing_condition.yes') }}
                @else
                  <i class='bi bi-x-circle-fill text-danger'></i>
                  {{ __('dog.adopter_detail.housing_condition.no') }}
                @endif
              </div>
              <div class="col-sm-6 image-wrapper\ ">
                  @php
                    $filename = $adoption->images->first()->filename;
                    $filename = explode('/', $filename);
                    $filename = end($filename);
                  @endphp
                <img src="{{ asset($stray_dog->images->first()->filename) }}" alt="{{ $filename }}" style="max-wid:100px;"  class=" img-fluid">
              </div>

              @if(!$adoption->housing_condition)
                <div class="alert alert-danger" role="alert">
                  {{ __('dog.adopter_detail.housing_condition.alert') }}
                </div>
              @endif
            </div>

            @if($adoption->residency_duration)
              <div class="d-flex align-items-center pt-4" style="gap: 10px">
                <div>
                  <small>{{ __('dog.adopter_detail.residency_duration.title') }}</small>
                  <p class="mb-0 fw-normal"><i class='bi bi-info-circle-fill text-warning pe-2'></i>{{ __('dog.adopter_detail.residency_duration.description', ['duration' => $adoption->residency_duration]) }}</p>
                  <div class="alert alert-warning" role="alert">
                    {{ __('dog.adopter_detail.residency_duration.alert') }}
                  </div>
                </div>
              </div>
            @endif

            @if($adoption->planned_residency_duration)
              <div class="d-flex align-items-center pt-2" style="gap: 10px">
                <div>
                  <small>{{ __('dog.adopter_detail.residence_duration_planned.title') }}</small>
                  <p class="mb-0 fw-normal"><i class='bi bi-info-circle-fill text-warning pe-2'></i>{{ __('dog.adopter_detail.residence_duration_planned.description', ['duration' => $adoption->planned_residency_duration ]) }}</p>
                  <div class="alert alert-warning" role="alert">
                    {{ __('dog.adopter_detail.residence_duration_planned.alert') }}
                  </div>
                </div>
              </div>
            @endif

            @if($adoption->future_residency_country)
              <div class="d-flex align-items-center pt-2" style="gap: 10px">
                <div>
                  <small>{{ __('dog.adopter_detail.future_residency_country.title') }}</small>
                  <p class="mb-0 fw-normal"><i class='bi bi-info-circle-fill text-warning pe-2'></i>{{ $adoption->future_residency_country }}</p>
                  <div class="alert alert-warning" role="alert">
                    {{ __('dog.adopter_detail.future_residency_country.alert') }}
                  </div>
                </div>
              </div>
            @endif

            @if($adoption->pet_migration_plan)
              <div class="d-flex align-items-center pt-2" style="gap: 10px">
                <div>
                  <small>{{ __('dog.adopter_detail.pet_migration_plan.title') }}</small>
                  <div class="mb-0 fw-normal d-flex" style="gap: 5px">
                    @if($adoption->pet_migration_plan)
                      <i class='bi bi-check-circle-fill text-success'></i>
                      {{ __('dog.adopter_detail.pet_migration_plan.yes') }}
                    @else
                      <i class='bi bi-x-circle-fill text-danger'></i>
                      {{ __('dog.adopter_detail.pet_migration_plan.no') }}
                    @endif
                  </div>

                  @if(!$adoption->pet_migration_plan)
                    <div class="alert alert-warning" role="alert">
                      {{ __('dog.adopter_detail.pet_migration_plan.alert') }}
                    </div>
                  @endif
                </div>
              </div>
            @endif
          </div>
        </div>

        <div class="d-flex align-items-start pt-3" style="gap: 10px">
          <i class="fa-solid fa-briefcase"></i>
          <div class="d-flex flex-column">
            <div>
              <small>{{ __('dog.adopter_detail.job.title') }}</small>
              <div class="mb-0 fw-normal d-flex" style="gap: 5px">
                {!! $adoption->job == "na" ? "<i class='bi bi-x-circle-fill text-danger'></i>" : "<i class='bi bi-info-circle-fill text-warning'></i>" !!}
                {{ __("adoption.option.$adoption->job") }}
              </div>

              @if($adoption->job == "na")
                <div class="alert alert-danger" role="alert">
                  {{ __('dog.adopter_detail.job.alert') }}
                </div>
              @else
                <div class="alert alert-warning" role="alert">
                  {{ __('dog.adopter_detail.job.alert') }}
                </div>
              @endif
            </div>

            @if(!empty($adoption->house_occupant))
              <div class="pt-2">
                <small>{{ __('dog.adopter_detail.house_occupants.title') }}</small>
                <div class="mb-0 fw-normal d-flex" style="gap: 5px">
                  @if( $adoption->house_occupants)
                    <i class='bi bi-check-circle-fill text-success'></i>
                    {{ __('dog.adopter_detail.house_occupants.alert') }}
                  @else
                    <i class='bi bi-x-circle-fill text-danger'></i>
                    {{ $adoption->canine_residence }}
                  @endif
                </div>
              </div>
            @endif
          </div>
        </div>

        <div class="d-flex align-items-start pt-3" style="gap: 10px">
          <!-- <h4><i class="fa-solid fa-dog"></i></h4> -->
          <i class="fa-solid fa-dog"></i>
          <div>
            <small>{{ __('dog.adopter_detail.pet_experience.title') }}</small>
            @if($adoption->pet_experience)
              @if($adoption->vaccinated)
                <p class="fw-normal">
                  <i class='bi bi-check-circle-fill text-success'></i>
                  {{ __('dog.adopter_detail.vaccinated.yes') }}
                </p>
              @else
                <p class="fw-normal">
                  <i class='bi bi-info-circle-fill text-warning'></i>
                  {{ __('dog.adopter_detail.vaccinated.no') }}
                  <div class="alert alert-warning" role="alert">
                    {{ __('dog.adopter_detail.vaccinated.alert') }}
                  </div>
                </p>
              @endif
            @else
              <i class='bi bi-info-circle-fill text-warning'></i>
              <p class="fw-normal">{{ __('dog.adopter_detail.pet_experience.no') }}</p>
              <div class="alert alert-warning" role="alert">
                {{ __('dog.adopter_detail.vaccinated.alert') }}
              </div>
            @endif
          </div>
        </div>
      </div>
      <!-- button approve-->

      <div class="modal-footer">
        @if($adoption->status == 'accepted')
          <form class="cancel-adoption" action="{{ route('adoptions.update', $adoption->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="status" value="cancel">
            <button type="submit" class="btn btn-mps mt-3 fw-normal w-100 btn-cancel-adoption">
              {{ __('app.button.cancel_adopter') }}
            </button>
          </form>
        @else
          <form id="accept-form" action="{{ route('adoptions.update', $adoption->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="status" value="accept">
            <button type="submit" class="btn btn-mps mt-3 fw-normal w-100">
              {{ __('app.button.accept_adopter') }}
            </button>
          </form>
        @endif
      </div>
    </div>
  </div>
</div>
