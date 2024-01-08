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

  <!-- MAP Link -->
  <div class="col-sm-6">
    <div class="d-flex align-items-center" style="gap: 15px;">
      <i class="bi bi-geo-alt dtl-icon"></i>
      <div>
        <small>Location</small><br/>
          <a href="{{$stray_dog->map_link}}">
            <h4 class="fw-bold">{{$stray_dog->area->name}}</h4>
          </a>
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

  @if($controller_name == "dog")
    <!-- Vaccinated -->
    <div class="col-sm-6">
      <div class="d-flex align-items-center" style="gap: 15px;">
        <img class="dtl-icon" src="{{ asset('images/covid_vaccine-protection-syringe.png') }}">
        <div>
          <small>Last Vacinnated</small><br/>
            <h4 class="fw-bold">{{$stray_dog->vaccinated_date}}</h4>
        </div>
      </div>
    </div>

    <!-- Sterilization -->
    <div class="col-sm-6">
      <div class="d-flex align-items-center" style="gap: 15px;">
      <img class="dtl-icon" src="{{ asset('images/healthicons_surgical-sterilization-outline.png') }}">
        <div>
          <small>Sterilization</small><br/>
            <h4 class="fw-bold">{{$stray_dog->sterilization_date}}</h4>
        </div>
      </div>
    </div>
  @endif

  <!-- description -->
  <div class="col-sm-12">
    <div class="d-flex align-items-center" style="gap: 15px;">
      <i class="bi bi-file-earmark-text dtl-icon"></i>
      <div>
        <small>{{ __('dog.form.description') }}</small><br/>
        <h4 class="fw-bold"><small>{{ ucfirst($stray_dog->description) }}</small></h4>
      </div>
    </div>
  </div>

  @if($controller_name === 'request' && $stray_dog->rescued)
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
