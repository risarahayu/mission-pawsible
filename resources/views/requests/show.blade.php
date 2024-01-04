@extends('layouts.app')

@section('content')
  <!-- Dog information -->
  <section id="dog_information">
    <div class="container">

      <!-- Dog information title -->
      <div class="main-card text-center">
        <h3 class="fw-bold m-1">{{ __('DOG INFORMATIONS') }}</h3>
      </div>

      <!-- Dog information detail -->
      <div class="row flex-lg-row flex-column-reverse">

        <div class="col-lg-6 dog-show">
          <div class="main-card d-flex justify-content-between">
            <div class="row">
              @if(Auth::id()==$stray_dog->user_id)
                <div class="col-12 mb-3">
                  <div class="d-flex justify-content-end" style="gap: 5px;">
                    <a type="button" class="btn btn-mps" href="{{ route('dogs.edit', $stray_dog->id) }}"><i class="bi bi-pencil-square me-2"></i> Update</a>
                    @if (!$stray_dog->adopted)
                      <form action="{{ route('dogs.destroy', $stray_dog->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                      </form>
                      <button class="btn btn-danger delete-dog">
                        <i class="bi bi-trash me-2"></i> Delete
                      </button>
                    @endif
                  </div>
                </div>
              @endif

              <!-- Dog type -->
              <div class="col-sm-6">
                <div class="d-flex align-items-center" style="gap: 15px;">
                  <img class="dtl-icon" src="{{ asset('images/dog-type.png') }}">
                  <div>
                    <small>Dog Type</small><br/>
                    <h4 class="fw-bold">{{ ucfirst($stray_dog->dog_type) }}</h4>
                  </div>
                </div>
              </div>

              <!-- gender -->
              <div class="col-sm-6">
                <div class="d-flex align-items-center" style="gap: 15px;">
                  <i class="bi bi-gender-ambiguous dtl-icon"></i>
                  <div>
                    <small>Gender</small><br/>
                    <h4 class="fw-bold">{{ ucfirst($stray_dog->gender) }}</h4>
                  </div>
                </div>
              </div>

              <!-- color -->
              <div class="col-sm-6">
                <div class="d-flex align-items-center" style="gap: 15px;">
                  <i class="bi bi-palette2 dtl-icon"></i>
                  <div>
                    <small>Color(s)</small><br/>
                    <h4 class="fw-bold">{{ ucfirst($stray_dog->color) }}</h4>
                  </div>
                </div>
              </div>

              <!-- size -->
              <div class="col-sm-6">
                <div class="d-flex align-items-center" style="gap: 15px;">
                  <img class="dtl-icon" src="{{ asset('images/cil_animal.png') }}">
                  <div>
                    <small>Size</small><br/>
                    <h4 class="fw-bold">{{ ucfirst($stray_dog->size) }}</h4>
                  </div>
                </div>
              </div>

              <!-- description -->
              <div class="col-sm-6">
                <div class="d-flex align-items-center" style="gap: 15px;">
                  <i class="bi bi-file-earmark-text dtl-icon"></i>
                  <div>
                    <small>Description</small><br/>
                    <h4 class="fw-bold">{{ ucfirst($stray_dog->description) }}</h4>
                  </div>
                </div>
              </div>

              <!-- contact -->
              <div class="col-sm-6">
                <div class="d-flex align-items-center" style="gap: 15px;">
                  <i class="bi bi-whatsapp dtl-icon"></i>
                  <div>
                    <small>By {{ $own->name }}</small><br/>
                    @if (optional($own->userContact)->whatsapp)
                      <h4 class="fw-bold">{{ optional($own->userContact)->whatsapp }}</h4>
                    @else
                      <h4 class="fw-bold">{{ $own->email }}</h4>
                    @endif
                  </div>
                </div>
              </div>

            </div>
          </div>

          <!-- Adoption button -->
          <div class="text-center w-100">
            @if($user->id != $own->id)
              @if($stray_dog->adopted == '1')
                <p class="fs-2">Someone already adopt this dog!</p>
              @elseif($stray_dog->adopted !== '1' && $userAdoption)
                <p class="fs-2">Keep Update!</p>
                <div class="btn btn-primary fw-bold fs-5">You already request this dog.</div>
                <p class="fs-6 mt-3">Waiting for approval from the owener</p>
              @else
                <a class="btn btn-mps w-100 fw-bold fs-5" href="{{ route('adoptions.create', ['dog' => $stray_dog->id]) }}">Adopt this dog</a>
              @endif
            @endif
          </div>
        </div>

        <div class="col-lg-6 text-center position-relative">

          <!--
          @if(Auth::id()==$stray_dog->user_id)
            <div class="show-buttons-group">
              <div class="d-flex justify-content-end" style="gap: 5px;">
                <a type="button" class="btn btn-mps" href="{{ route('dogs.edit', $stray_dog->id) }}"><i class="bi bi-pencil-square me-2"></i> Update</a>
                @if (!$stray_dog->adopted)
                  <button class="btn btn-danger delete-dog">
                    <i class="bi bi-trash me-2"></i> Delete
                  </button>
                @endif
              </div>
            </div>
          @endif
          -->

          <div id="carouselExampleIndicators" class="dog-picture-wrapper carousel slide" data-bs-ride="true">
            <div class="carousel-indicators">
              @foreach ($stray_dog->images()->orderBy('category')->get() as $index => $image)
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $index }}" class="@if($index === 0) active @endif" aria-current="true" aria-label="Slide {{ $index }}"></button>
              @endforeach
            </div>
            <div class="carousel-inner">
              @foreach ($stray_dog->images()->orderBy('category')->get() as $index => $image)
                <div class="carousel-item @if($index === 0) active @endif">
                  <div class="dog-picture mx-auto">
                    <img class="rounded" src="{{ asset($image->filename) }}">
                  </div>
                </div>
              @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
          <!-- <img class="img-fluid p-5 d-none d-md-block" src="{{ asset('images/lets-chat-withus.svg') }}"> -->

        </div>
      </div>
    </div>
  </section>

  <section>
    <div class="container">
      <div class="row mt-5">
      @if($stray_dog->rescued == '1')
      <div class="card">
        <h5 class="card-title bold card-header"><i class="bi bi-person-circle me-3"></i>{{ $rescuer->user->first_name }} {{ $rescuer->user->last_name }}</h5>
        <div class="card-body">
          @if(Auth::id() == $finder->id || Auth::id() == $rescuer->rescuer_id)
            <div class="d-flex align-items-center" style="gap: 10px">
              <h4><i class="bi bi-envelope"></i></h4>
              <div>
                <small>Email</small>
                <p class="mb-0 fw-bold">{{ empty($rescuer->user->email) ? "-" : $rescuer->user->email }}</p>
              </div>
            </div>
            <div class="d-flex align-items-center" style="gap: 10px">
              <h4><i class="bi bi-whatsapp"></i></h4>
              <div>
                <small>Whatsapp</small>
                <p class="mb-0 fw-bold">{{ empty($rescuer->user->whatsapp) ? "-" : $rescuer->whatsapp }}</p>
              </div>
            </div>
            <div id="carouselExampleIndicators" class="dog-picture-wrapper carousel slide mt-5" data-bs-ride="true">
              <div class="carousel-indicators">
                @foreach ($stray_dog->images->where('request_status', 'rescuer') as $image)
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $loop->index }}" class="@if($loop->index === 0) active @endif" aria-current="true" aria-label="Slide {{ $loop->index }}"></button>
                @endforeach
              </div>
              @endif
            <div class="carousel-inner">
              @foreach ($stray_dog->images->where('request_status', 'rescuer') as $image)
                <div class="carousel-item @if($loop->index === 0) active @endif">
                  <div class="dog-picture mx-auto">
                    <img class="rounded" src="{{ asset($image->filename) }}">
                  </div>
                </div>
              @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
      </div>
      @else
        <div class="d-flex align-items-center h-100">
          <div class="card w-100">
            <div class="card-header">{{ __('Rescue this dog') }}</div>

            <div class="card-body">
              <form method="POST" action="{{ route('requests.rescue', ['request' => $stray_dog->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <label for="images" class="col-md-4 col-form-label">{{ __('Pictures') }}</label>
                <div class="col-md-8">
                  <input id="images" type="file" class="form-control @error('images') is-invalid @enderror" name="images[]" autocomplete="images" multiple>
                  @error('images')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <button type="submit" class="btn btn-custom-submit w-100">
                  {{ __('Submit') }}
                </button>
              </form>
            </div>
          </div>
        </div>
      @endif
      </div>
    </div>
  </section>
@endsection

@section('scripts')
<script type="module">
  $(function() {
    $('.delete-dog').click(function() {
      var self = $(this);
      Swal.fire({
        title: 'Are you sure?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#BD1A8D',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
          self.parent().find('form').submit();
        }
      })
    });
  })
</script>
@endsection
