<!-- MODAL -->
<div class="modal fade" id="rescuer_information" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="rescuer_information_label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <button type="button" class="btn-close pt-3 ps-3" aria-label="Close" data-bs-dismiss="modal"></button>
      <!-- <button type="button" class="btn btn-secondary" style="min-width: 100px" data-bs-dismiss="modal">Close</button> -->
      <div class="modal-header justify-content-center">
        <h1 class="modal-title fs-5" id="rescuer_information_label">
          <i class="bi bi-person-circle me-2"></i>{{ $adoption->user->first_name . ' ' . $adoption->user->last_name }}
        </h1>
      </div>
      <div class="modal-header justify-content-center">
        <h1 class="modal-title fs-5" id="rescuer_information_label">
          @if($adoption->residency_duration==null)
            Indonesian
          @else
           Foreigner
          @endif
        </h1>
      </div>
      <div class="modal-body py-4 px-5">
        <div class="d-flex  align-items-start" style="gap: 10px">
          <!-- <h6><i class="fa-solid fa-house"></i></h6> -->
          <i class="fa-solid fa-house"></i>
          <div class="d-flex flex-column">
            <div>
              <small>Housing type</small>
              <p class="mb-0 fw-bold">{{ $adoption->housing_type }}</p>
            </div>

            <div class="pt-2">
              <small>Housing condition</small>
              <p class="mb-0 fw-bold">
                @if($adoption->housing_condition)
                Yard fully enclosed without the use of cages, chains, or unrestricted animal roaming
                @else
                  Yard is not full enclose
                @endif
              </p>
            </div>
            @if($adoption->residency_duration)
              <div class="d-flex align-items-center pt-2" style="gap: 10px">
                <!-- <h6><i class="fa-solid fa-calendar"></i></h6> -->
                <div>
                  <small>Residence Duration</small>
                  <p class="mb-0 fw-bold">Has been living in Bali for {{$adoption->residency_duration}}</p>
                </div>
              </div>
            @endif
            @if($adoption->planned_residency_duration)
              <div class="d-flex align-items-center pt-2" style="gap: 10px">
                <!-- <h6><i class="fa-solid fa-calendar"></i></h6> -->
                <div>
                  <small>Residence Duration Planned</small>
                  <p class="mb-0 fw-bold">Plan to stay for {{ $adoption->planned_residency_duration }} in Bali</p>
                </div>
              </div>
            @endif
            @if($adoption->future_residency_country)
              <div class="d-flex align-items-center pt-2" style="gap: 10px">
                <!-- <h6><i class="fa-solid fa-flag"></i></h6> -->
                <div>
                  <small>Future Residency Country</small>
                  <p class="mb-0 fw-bold">{{ $adoption->future_residency_country }}</p>
                </div>
              </div>
            @endif
            @if($adoption->pet_migration_plan)
              <div class="d-flex align-items-center pt-2" style="gap: 10px">
                <!-- <h6><i class="fa-solid fa-dog"></i></h6> -->
                <div>
                  <small>Pet Migration Plan</small>
                  <p class="mb-0 fw-bold">
                    @if($adoption->pet_migration_plan==true)
                    Plan to relocate with the pet
                    @else
                    Have no plan to relocate with the pet
                    @endif
                  </p>
                </div>
              </div>
            @endif
          </div>
        </div>
        <div class="d-flex align-items-start pt-3" style="gap: 10px">
          <!-- <h6><i class="fa-solid fa-briefcase"></i></h6> -->
          <i class="fa-solid fa-briefcase"></i>
          <div class="d-flex flex-column">
            <div>
              <small>Job</small>
              <p class="mb-0 fw-bold">{{ $adoption->job }}</p>
            </div>
            <div class="pt-2">
              <small>House Occupants</small>
              <p class="mb-0 fw-bold">
                @if( $adoption->house_occupants)
                There is someone present at home to look after the dogs throughout the day
                @else
                  {{ $adoption->canine_residence }}
                @endif</p>
            </div>
          </div>
        </div>

        <div class="d-flex align-items-start pt-3" style="gap: 10px">
          <!-- <h4><i class="fa-solid fa-dog"></i></h4> -->
          <i class="fa-solid fa-dog"></i>
          <div>
            <small>Pet Experience</small>
            @if($adoption->vaccinated==true)
              <p class="fw-bold">Have experience with vaccinated dog</p>
            @elseif($adoption->vaccinated==false)
              <p class="fw-bold">Don't have experience with vaccinated dog</p>
            @else
              <p class="fw-bold">Don't have experience</p>
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
            <button type="submit" class="btn btn-mps mt-3 fw-bold w-100 btn-cancel-adoption">
              {{ __('Cancel Adopter') }}
            </button>
          </form>
        @else
          <form id="accept-form" action="{{ route('adoptions.update', $adoption->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="status" value="accept">
            <button type="submit" class="btn btn-mps mt-3 fw-bold w-100">
              {{ __('Accept Adopter') }}
            </button>
          </form>
        @endif
      </div>
    </div>
  </div>
</div>