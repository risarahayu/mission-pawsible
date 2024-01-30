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
              <div class="mb-0 fw-normal d-flex" style="gap: 5px;">
                @if($adoption->housing_type == "compound" || $adoption->housing_type == "private_villa")
                    <i class='bi bi-check-circle-fill text-success'></i>
                @elseif($adoption->housing_type == "guesthouse")
                    <i class='bi bi-info-circle-fill text-warning'></i>
                @else
                    <i class='bi bi-x-circle-fill text-danger'></i>
                @endif

                {{ ucfirst($adoption->housing_type) }}
              </div>

              @if($adoption->housing_type == "guesthouse")
                <div class="alert alert-warning" role="alert">
                  Not all guesthouses are the same, make sure the guesthouse is safe and does not restrict the well-being of the dog
                </div>
              @elseif($adoption->housing_type == "kos")
                <div class="alert alert-danger" role="alert">
                  Avoid adopters in dorms due to limited space. Opt for stable, spacious homes for pets' well-being.
                </div>
              @endif
            </div>

            <div class="pt-2">
              <small>Housing condition</small>
              <div class="mb-0 fw-normal d-flex" style="gap: 5px">
                @if($adoption->housing_condition)
                  <i class='bi bi-check-circle-fill text-success'></i>
                  Yard fully enclosed without the use of cages, chains, or unrestricted animal roaming
                @else
                  <i class='bi bi-x-circle-fill text-danger'></i>
                  Yard is not full enclose
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
                  We avoid adopters who are accustomed to using cages, chains, or allowing unrestricted animal roaming.
                </div>
              @endif
            </div>

            @if($adoption->residency_duration)
              <div class="d-flex align-items-center pt-4" style="gap: 10px">
                <!-- <h6><i class="fa-solid fa-calendar"></i></h6> -->
                <div>
                  <small>Residence Duration</small>
                  <p class="mb-0 fw-normal"><i class='bi bi-info-circle-fill text-warning pe-2'></i>Has been living in Bali for {{$adoption->residency_duration}}</p>
                  <div class="alert alert-warning" role="alert">
                    Long-term residence in a place can indicate stability, which is a positive factor for the well-being of pets.
                  </div>
                </div>
              </div>
            @endif

            @if($adoption->planned_residency_duration)
              <div class="d-flex align-items-center pt-2" style="gap: 10px">
                <!-- <h6><i class="fa-solid fa-calendar"></i></h6> -->
                <div>
                  <small>Residence Duration Planned</small>
                  <p class="mb-0 fw-normal"><i class='bi bi-info-circle-fill text-warning pe-2'></i>Plan to stay for {{ $adoption->planned_residency_duration }} in Bali</p>
                  <div class="alert alert-warning" role="alert">
                    Ensure that potential adopters can be relied upon for the long term or have a stable residence (not frequently moving).
                  </div>
                </div>
              </div>
            @endif

            @if($adoption->future_residency_country)
              <div class="d-flex align-items-center pt-2" style="gap: 10px">
                <!-- <h6><i class="fa-solid fa-flag"></i></h6> -->
                <div>
                  <small>Future Residency Country</small>
                  <p class="mb-0 fw-normal"><i class='bi bi-info-circle-fill text-warning pe-2'></i>{{ $adoption->future_residency_country }}</p>
                  <div class="alert alert-warning" role="alert">
                    It is important to ensure that pet owners understand the requirements and needs of pets in the destination country due to differences in regulations, environmental conditions, and healthcare services between countries.
                  </div>
                </div>
              </div>
            @endif

            @if($adoption->pet_migration_plan)
              <div class="d-flex align-items-center pt-2" style="gap: 10px">
                <!-- <h6><i class="fa-solid fa-dog"></i></h6> -->
                <div>
                  <small>Pet Migration Plan</small>
                  <div class="mb-0 fw-normal d-flex" style="gap: 5px">
                    @if($adoption->pet_migration_plan)
                      <i class='bi bi-check-circle-fill text-success'></i>
                      Plan to relocate with the pet
                    @else
                      <i class='bi bi-x-circle-fill text-danger'></i>
                      Have no plan to relocate with the pet
                    @endif
                  </div>

                  @if(!$adoption->pet_migration_plan)
                    <div class="alert alert-warning" role="alert">
                      Ensure that potential adopters are responsible and committed in this matter
                    </div>
                  @endif
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
              <div class="mb-0 fw-normal d-flex" style="gap: 5px">
                {!! $adoption->job == "na" ? "<i class='bi bi-x-circle-fill text-danger'></i>" : "<i class='bi bi-info-circle-fill text-warning'></i>" !!}
                {{ strtoupper($adoption->job) }}
              </div>

              @if($adoption->job == "na")
                <div class="alert alert-danger" role="alert">
                  We recommend adopters who are already employed. However, what's crucial is that the adopter you choose is responsible and capable.
                </div>
              @else
                <div class="alert alert-warning" role="alert">
                  We recommend adopters who are already employed. However, what's crucial is that the adopter you choose is responsible and capable.
                </div>
              @endif
            </div>

            <div class="pt-2">
              <small>House Occupants</small>
              <div class="mb-0 fw-normal d-flex" style="gap: 5px">
                @if( $adoption->house_occupants)
                  <i class='bi bi-check-circle-fill text-success'></i>
                  There is someone present at home to look after the dogs throughout the day
                @else
                  <i class='bi bi-x-circle-fill text-danger'></i>
                  {{ $adoption->canine_residence }}
                @endif
              </div>
            </div>
          </div>
        </div>

        <div class="d-flex align-items-start pt-3" style="gap: 10px">
          <!-- <h4><i class="fa-solid fa-dog"></i></h4> -->
          <i class="fa-solid fa-dog"></i>
          <div>
            <small>Pet Experience</small>
            @if($adoption->vaccinated==true)
              <p class="fw-normal">
                <i class='bi bi-check-circle-fill text-success'></i>
                Have experience with vaccinated dog
              </p>
            @elseif($adoption->vaccinated==false)
              <p class="fw-normal">
                <i class='bi bi-info-circle-fill text-warning'></i>
                Don't have experience with vaccinated dog
                <div class="alert alert-warning" role="alert">
                  We recommend adopters who have experience in vaccination. Make sure that the potential adopter has knowledge in dog vaccination.
                </div>
              </p>
            @else
              <i class='bi bi-info-circle-fill text-warning'></i>
              <p class="fw-normal">Don't have experience</p>
              <div class="alert alert-warning" role="alert">
                We recommend adopters who have experience in vaccination. Make sure that the potential adopter has knowledge in dog vaccination.
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
              {{ __('Cancel Adopter') }}
            </button>
          </form>
        @else
          <form id="accept-form" action="{{ route('adoptions.update', $adoption->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="status" value="accept">
            <button type="submit" class="btn btn-mps mt-3 fw-normal w-100">
              {{ __('Accept Adopter') }}
            </button>
          </form>
        @endif
      </div>
    </div>
  </div>
</div>