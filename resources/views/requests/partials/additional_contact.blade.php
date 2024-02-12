
@if(!$stray_dog->rescued)
  <img class="step-image" src="{{asset('images/step/step 3.svg')}}" alt="">
  <div class="text-center m-auto my-2 text-base-color">
    <p class="fs-4 m-0">{{ __('app.step.third') }}</p>
    <p class="alert  m-auto mb-3">{{ __('rescue.additional_contact.title') }}</p>
  </div>

  <!-- STEP -->
  <div class="form-card">
    <div class="accordion accordion-flush" id="accordionFlushExample">
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
            <i class="bi bi-chat-text-fill pe-2"></i>{{ __('rescue.additional_contact.rescuer_list') }}
          </button>
        </h2>
        <div id="flush-collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionFlushExample">
          <div class="accordion-body">
            <div class="form-card text-center">
              <h1 class="modal-title fs-5" id="rescue_label">{{ __('rescue.additional_contact.choose_rescuer') }}</h1>
            </div>
            <div class="row">

              @foreach($users as $user)
                <div class="col-md-4">
                  @include('admins.partials.rescuer_card', ['user' => $user])
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
            <img src="{{asset('images/fa6-solid_shield-dog.svg')}}" alt="" class="pe-2" style="max-width:24px;">{{ __('rescue.additional_contact.upload_proof') }}
          </button>
        </h2>
        <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
          <div class="accordion-body">
            <div class="form-card text-center">
              <h1 class="modal-title fs-5" id="rescue_label">{{ __('rescue.additional_contact.rescue_dog') }}</h1>
            </div>
            <div class="form-card">
              <form method="POST" action="{{ route('requests.rescue', ['request' => $stray_dog->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-body py-5">
                  <label for="images" class="col-md-4 col-form-label">{{ __('rescue.additional_contact.picture') }}</label>
                  <div class="col">
                    <input id="images" type="file" class="form-control @error('images') is-invalid @enderror" name="images[]" autocomplete="images" multiple>
                    @error('images')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>

                  <!-- Solo Rescuer Dropdown -->
                  <div class=" mt-4">
                    <label for="solo rescuer" class="form-label">{{ __('rescue.rescuer') }}</label>
                    <select class="form-select calculate-score" id="rescuer" name="rescuer_id" required>
                      @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->first_name.' '.$user->last_name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="modal-footer justify-content-center">
                  <!-- <button type="button" class="btn btn-secondary" style="min-width: 100px" data-bs-dismiss="modal">Close</button> -->
                  <button type="button" class="btn btn-primary need-confirm" style="min-width: 100px">{{ __('app.button.save') }}</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@else
  <img class="step-image" src="{{asset('images/step/step 3 finish.svg')}}" alt="">
  <div class="text-center m-auto my-2 text-base-color">
    <p class="fs-4 m-0">{{ __('app.step.finish') }}</p>
    <p class="alert  m-auto mb-3">Thank you for your help!</p>
  </div>
  <div class="row">
    <div class="col-md-6">
      @include('dogs.partials.dog_carousel',['stray_dog'=> $stray_dog, 'carousel_type' => 'rescuer'])
    </div>
    <div class="col-md-6">
      @include('admins.partials.rescuer_card', ['user' => $stray_dog->rescuer])
    </div>
  </div>
@endif
