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

          <form action="{{ route('dogs.destroy', $stray_dog->id) }}" method="POST">
            @csrf
            @method('DELETE')
          </form>

          <div id="carouselExampleIndicators" class="dog-picture-wrapper carousel slide" data-bs-ride="true">
            <div class="carousel-indicators">
              @foreach ($stray_dog->images as $index => $image)
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $index }}" class="@if($index === 0) active @endif" aria-current="true" aria-label="Slide {{ $index }}"></button>
              @endforeach
            </div>
            <div class="carousel-inner">
              @foreach ($stray_dog->images as $index => $image)
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
  
  <!-- Adoption infromation -->
  <section id="dog_adoption">
    <div class="container">

      <!-- Dog information title -->
      <div class="main-card text-center mt-4">
        <h3 class="fw-bold m-1">{{ __('Adopters') }}</h3>
      </div>
      
      @if(Auth::id() == $own->id)
        <div class="row">
          @foreach ($adoptions as $adoption)
            <div class="col-md-4">
              <div class="dog-card">
                <div class="brief">
                  <div class="wrapper">

                    <h4 class="text-center fw-bold">{{ $adoption->user->name }}</h4>
                    <hr class="mt-1">
                    <div class="gender">
                      <i class="bi bi-envelope dtl-icon"></i>
                      <div>
                        <small>Gender</small><br/>
                        <h4 class="fw-bold">{{ empty($adoption->user->email) ? "not set" : $adoption->user->email }}</h4>
                      </div>
                    </div>
                    <div class="size">
                      <i class="bi bi-whatsapp dtl-icon"></i>
                      <div>
                        <small>Size</small><br/>
                        <h4 class="fw-bold">{{ empty($adoption->user->whatsapp) ? "not set" : $adoption->user->whatsapp }}</h4>
                      </div>
                    </div>
                    
                    @if($adoption->status == 'accepted')
                      <form class="cancel-adoption" action="{{ route('adoptions.update', $adoption->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="cancel">
                        <button type="submit" class="btn btn-mps mt-3 fw-bold w-100 btn-cancel-adoption">
                          {{ __('Cancel') }}
                        </button>
                      </form>
                    @else
                      <form id="accept-form" action="{{ route('adoptions.update', $adoption->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="accept">
                        <button type="submit" class="btn btn-mps mt-3 fw-bold w-100">
                          {{ __('Accept') }}
                        </button>
                      </form>
                    @endif
                    
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      @endif
      
    </div>
  </section>
@endsection

@section('scripts')
  @if(Auth::id()==$stray_dog->user_id)
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
  @endif
@endsection
