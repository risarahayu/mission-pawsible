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
          <div class="main-card">
            <!-- Action button -->
            <div class="d-flex justify-content-end" style="gap: 5px;">
              @if(Auth::id()==$stray_dog->user_id)
                <a type="button" class="btn btn-mps" href="{{ route('requests.edit', $stray_dog->id) }}"><i class="bi bi-pencil-square me-2"></i> {{ __('app.button.edit') }}</a>
                @if (!$stray_dog->rescued)
                  <form action="{{ route('requests.destroy', $stray_dog->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                  </form>
                  <button class="btn btn-danger delete-dog">
                    <i class="bi bi-trash me-2"></i> Delete
                  </button>
                @endif
              @else
                @unless($stray_dog->rescued == '1')
                  <a type="button" class="btn btn-rescue" data-bs-toggle="modal" data-bs-target="#rescue">
                    <i class="fa-solid fa-hand-holding-heart me-2"></i> Rescue
                  </a>
                @endunless
              @endif
            </div>

            <!-- Dog details -->
            @include('dogs.partials.dog_detail')
          </div>
        </div>

        <div class="col-lg-6 text-center position-relative">
          <!-- Dog picture carousel -->
          @include('dogs.partials.dog_carousel')
        </div>
      </div>
    </div>

    @if(Auth::id() == $stray_dog->user_id)
      <div class="modal fade" id="rescuer_information" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="rescuer_information_label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header justify-content-center">
              <h1 class="modal-title fs-5" id="rescuer_information_label">
                <i class="bi bi-person-circle me-2"></i>{{ $rescuer->user->first_name . ' ' . $rescuer->user->last_name }}
              </h1>
            </div>
            <div class="modal-body py-4 px-5">
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
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" style="min-width: 100px" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    @else
      <div class="modal fade" id="rescue" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="rescue_label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header justify-content-center">
              <h1 class="modal-title fs-5" id="rescue_label">{{ __('Rescue this dog') }}</h1>
            </div>
            <form method="POST" action="{{ route('requests.rescue', ['request' => $stray_dog->id]) }}" enctype="multipart/form-data">
              @csrf
              @method('PUT')

              <div class="modal-body py-5">
                <label for="images" class="col-md-4 col-form-label">{{ __('Pictures') }}</label>
                <div class="col">
                  <input id="images" type="file" class="form-control @error('images') is-invalid @enderror" name="images[]" autocomplete="images" multiple>
                  @error('images')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" style="min-width: 100px" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" style="min-width: 100px">{{ __('Submit') }}</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    @endif
  </section>

  @if(false)
    <section>
      <div class="container">
        <div class="row mt-5">
        @if($stray_dog->rescued == '1')
          <div class="card">
            <h5 class="card-title bold card-header"><i class="bi bi-person-circle me-3"></i>{{ $rescuer->user->first_name }} {{ $rescuer->user->last_name }}</h5>
            <div class="card-body">
              @if(Auth::id() == $own->id || Auth::id() == $rescuer->rescuer_id)
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
          @if(false)
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
        @endif
        </div>
      </div>
    </section>
  @endif
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
