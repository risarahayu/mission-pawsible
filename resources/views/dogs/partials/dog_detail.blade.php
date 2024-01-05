<div class="row">
  <!-- Dog type -->
  <div class="col-sm-6">
    <div class="d-flex align-items-center" style="gap: 15px;">
      <img class="dtl-icon" src="{{ asset('images/dog-type.png') }}">
      <div>
        <small>{{ __('dog.form.dog_type') }}</small><br/>
        <h4 class="fw-bold">{{ ucfirst($stray_dog->dog_type) }}</h4>
      </div>
    </div>
  </div>

  <!-- gender -->
  <div class="col-sm-6">
    <div class="d-flex align-items-center" style="gap: 15px;">
      <i class="bi bi-gender-ambiguous dtl-icon"></i>
      <div>
        <small>{{ __('dog.form.gender') }}</small><br/>
        <h4 class="fw-bold">{{ __("dog.form.option.$stray_dog->gender") }}</h4>
      </div>
    </div>
  </div>

  <!-- color -->
  <div class="col-sm-6">
    <div class="d-flex align-items-center" style="gap: 15px;">
      <i class="bi bi-palette2 dtl-icon"></i>
      <div>
        <small>{{ __('dog.form.color') }}</small><br/>
        <h4 class="fw-bold">{{ ucfirst($stray_dog->color) }}</h4>
      </div>
    </div>
  </div>

  <!-- size -->
  <div class="col-sm-6">
    <div class="d-flex align-items-center" style="gap: 15px;">
      <img class="dtl-icon" src="{{ asset('images/cil_animal.png') }}">
      <div>
        <small>{{ __('dog.form.size') }}</small><br/>
        <h4 class="fw-bold">{{ __("dog.form.option.$stray_dog->size") }}</h4>
      </div>
    </div>
  </div>

  <!-- description -->
  <div class="col-sm-6">
    <div class="d-flex align-items-center" style="gap: 15px;">
      <i class="bi bi-file-earmark-text dtl-icon"></i>
      <div>
        <small>{{ __('dog.form.description') }}</small><br/>
        <h4 class="fw-bold">{{ ucfirst($stray_dog->description) }}</h4>
      </div>
    </div>
  </div>

  <!-- contact -->
  <div class="col-sm-6">
    <div class="d-flex align-items-center" style="gap: 15px;">
      <i class="bi bi-whatsapp dtl-icon"></i>
      <div>
        <small>{{ __('dog.show.registered_by') }} {{ $own->first_name }} {{ $own->last_name }}</small><br/>
        @if (optional($own->userContact)->whatsapp)
          <h4 class="fw-bold">{{ optional($own->userContact)->whatsapp }}</h4>
        @else
          <h4 class="fw-bold">{{ $own->email }}</h4>
        @endif
      </div>
    </div>
  </div>

  @if($controller_name === 'rescue_request' && $stray_dog->rescued)
    <div class="col-sm-6">
      <div class="d-flex align-items-center" style="gap: 15px;">
        <i class="fa-solid fa-hand-holding-heart me-2"></i>
        <div>
          <small>Rescued By {{ $own->name }}</small><br/>
          <a class="cursor-pointer custom-link" data-bs-toggle="modal" data-bs-target="#rescuer_information">
            <h4 class="fw-bold">{{ $own->first_name . ' ' . $own->last_name }}</h4>
          </a>
        </div>
      </div>
    </div>
  @endif

</div>
