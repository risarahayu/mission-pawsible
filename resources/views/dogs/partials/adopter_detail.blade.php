<!-- Adoption infromation -->
@if(Auth::id() == $own->id)
    <section id="dog_adoption">
      <div class="container">
      @if(!$stray_dog->adopted)
        @if($stray_dog->adoptions->count() == 0)
          <img class="step-image pt-5" src="{{asset('images/step/step 3.svg')}}" alt="">
          <div class="text-center m-auto my-2 text-base-color fs-5 "> 
            Waiting for Potential Adopter
          </div>
          <!-- colapse -->
          <!-- <div class="text-center">
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
              How to get an adopter <i class="bi bi-caret-down-fill"></i>
            </button>
            <div class="collapse" id="collapseExample">
              <div class="card card-body">
                <p class="alert alert-warning  mb-3 text-start">
                  <span class="fw-semibold"><i class="bi bi-1-circle-fill"></i> Monitor the status of your dog</span><br>
                  You can promote your dog on various social media platforms, <br>and we highly recommend directing interested 
                  individuals <br>to submit adoption applications through our website for security purposes.
                </p>

                <p class="alert alert-warning  mb-3 text-start">
                  <span class="fw-semibold"><i class="bi bi-2-circle-fill"></i> Review potential adopter</span><br>
                  Review the adoption details provided by potential adopters and consider any recommendations given.
                </p>

                <p class="alert alert-warning  mb-3 text-start">
                  <span class="fw-semibold"><i class="bi bi-3-circle-fill"></i> Conduct an interview with the potential adopter</span><br>
                  If need, Communicate with them to gather additional information and get to know them better.
                </p>

                <p class="alert alert-warning  mb-3 text-start">
                  <span class="fw-semibold"><i class="bi bi-4-circle-fill"></i> Accept one of the adopters.</span>
                </p>

                <p class="alert alert-warning  mb-3 text-start">
                  <span class="fw-semibold"><i class="bi bi-5-circle-fill"></i> Follow up with further communication regarding the dog's pickup arrangements</span>
                </p>
              </div>
            </div>
          </div> -->
        
          <p class="alert alert-info m-auto mb-3 text-center">
            <span class="fw-semibold">Monitor the status of your dog</span><br>
            You can promote your dog on various social media platforms, <br>and we highly recommend directing interested 
            individuals <br>to submit adoption applications through our website for security purposes.
          </p>
        @elseif($stray_dog->adoptions->count() > 0)
          <img class="step-image pt-5" src="{{asset('images/step/step 3.svg')}}" alt="">
          <div class="text-center m-auto my-2 text-base-color fs-5 "> 
            Adopter Selection
          </div>
          <p class="alert alert-info m-auto mb-3 text-center">
            <span class="fw-semibold">Review the potential adopters and conduct interview by Whatsapp</span><br>
            You can review the social media profiles of potential adopters, then accept one adopter.
          </p>
        @endif
      @else
        <img class="step-image pt-5" src="{{asset('images/step/step 3 finish.svg')}}" alt="">
        <div class="text-center m-auto my-2 text-base-color fs-5 "> 
          Chat your new dog adopter!
        </div>
        <p class="text-center">Please coordinate among yourselves for the pickup of the dog. Congratulations!</p>
      @endif


        @if ($adoptions->count() > 0)
          <!-- Dog information title -->
          <div class="main-card text-center mt-4">
            {!! $stray_dog->adopted ? "<h3>New Adopter</h3>" : "<h3>Adopters</h3> We found " . $stray_dog->adoptions->count()." Potential adopters" !!}
            <div class="alert m-auto d-flex justify-content-center border-top mt-3"  role="alert">
              <i class="bi bi-info-square-fill me-2 text-warning"></i>
              <p>All those who register as adopters have agreed to <span type="button" class="text-decoration-underline"  data-bs-toggle="modal" data-bs-target="#exampleModal">the terms</span><br> and have permission from their family or those around them</p>
            </div>
          </div>
          <!-- term modal -->
          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  ...
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            @if(!$stray_dog->adopted)
              @foreach ($adoptions as $adoption)
                <div class="col-md-4 pb-3">
                  <!-- ADOPTIONS CARD HERE -->
                  @include('dogs.partials.adopters_card', ['adoption' => $adoption])
                  <!-- MODAL HERE -->
                  @include('dogs.partials.modal_adopter', ['adoption' => $adoption])
                </div>
              @endforeach
            @else
              <div class="dog-card col-md-6 m-auto">
                <div class="brief">
                  <div class="wrapper">
                    <!-- ADOPTER CARD HERE -->
                    @include('dogs.partials.adopters_card', ['adoption' => $own_new])

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
              <p class="m-0 mt-2 txt-1">No adopter yet</p>
            </div>
          </div>
        @endif

      </div>
    </section>
  @endif
