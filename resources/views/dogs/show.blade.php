@extends('layouts.app')

@section('content')
  <section>
    <div class="container">
      <div class="row flex-md-row flex-column-reverse">
        <div class="col-md-6 dog-show">
          <div class="row">
            <div class="col-6">
              <div class="d-flex align-items-center" style="gap: 15px;">
                <img class="dtl-icon" src="{{ asset('images/dog-type.png') }}">
                <div>
                  <small>Dog Type</small><br/>
                  <h4 class="fw-bold">{{ ucfirst($stray_dog->dog_type) }}</h4>
                </div>
              </div>
            </div>

            <div class="col-6">
              <div class="d-flex align-items-center" style="gap: 15px;">
                <i class="bi bi-gender-ambiguous dtl-icon"></i>
                <div>
                  <small>Gender</small><br/>
                  <h4 class="fw-bold">{{ ucfirst($stray_dog->gender) }}</h4>
                </div>
              </div>
            </div>

            <div class="col-6">
              <div class="d-flex align-items-center" style="gap: 15px;">
                <i class="bi bi-palette2 dtl-icon"></i>
                <div>
                  <small>Color(s)</small><br/>
                  <h4 class="fw-bold">{{ ucfirst($stray_dog->color) }}</h4>
                </div>
              </div>
            </div>

            <div class="col-6">
              <div class="d-flex align-items-center" style="gap: 15px;">
                <img class="dtl-icon" src="{{ asset('images/cil_animal.png') }}">
                <div>
                  <small>Size</small><br/>
                  <h4 class="fw-bold">{{ ucfirst($stray_dog->size) }}</h4>
                </div>
              </div>
            </div>

            <div class="col-6">
              <div class="d-flex align-items-center" style="gap: 15px;">
                <i class="bi bi-file-earmark-text dtl-icon"></i>
                <div>
                  <small>Description</small><br/>
                  <h4 class="fw-bold">{{ ucfirst($stray_dog->description) }}</h4>
                </div>
              </div>
            </div>
            
            <div class="col-6">
              <div class="d-flex align-items-center" style="gap: 15px;">
                <i class="bi bi-whatsapp dtl-icon"></i>
                <div>
                  
                  <a href="{{-- route('user_contacts.show', $own->id) --}}"><small>By {{ $own->name }}</small></a><br/>
                  <h4 class="fw-bold">{{ optional($own->userContact)->whatsapp }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 text-center">
          @if(Auth::id()==$stray_dog->user_id)
            <div class="mb-5 d-flex justify-content-end" style="gap: 5px;">
              <a type="button" class="btn btn-custom-submit" href="{{ route('dogs.edit', $stray_dog->id) }}"><i class="bi bi-pencil-square me-2"></i>edit</a>
              @if (!$stray_dog->adopted)
                <button class="btn btn-danger delete-dog">
                  <i class="bi bi-trash me-2"></i>delete
                </button>
                <form action="{{ route('dogs.destroy', $stray_dog->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                </form>
              @endif
            </div>
          @endif
          <div id="carouselExampleIndicators" class="dog-picture-wrapper carousel slide mt-5" data-bs-ride="true">
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
      <div class="row justify-content-center mt-5  ">
        <div class="col-6 text-center">
          @if($user->id != $own->id)
            @if($stray_dog->adopted == '1')
              <p class="fs-2">Someone already adopt this dog!</p>
            @elseif($stray_dog->adopted !== '1' && $userAdoption)
              <p class="fs-2">Keep Update!</p>
              <div class="btn btn-primary text-align">You already request this dog.</div>
              <p class="fs-6 mt-3">Waiting for approval from the owener</p>
            @else
              <a href="{{ route('adoptions.create', ['dog' => $stray_dog->id]) }}">goto adoption</a>
            @endif
          @endif
        </div>
      </div>
      @if(Auth::id() == $own->id)
        <div class="row">
          @foreach ($adoptions as $adoption)
            <div class="col-md-4">
              <div class="card">
                <h5 class="card-title bold card-header"><i class="bi bi-person-circle me-3"></i>{{ $adoption->user->name }}</h5>
                <div class="card-body">
                  <div class="d-flex align-items-center" style="gap: 10px">
                    <h4><i class="bi bi-envelope"></i></h4>
                    <div>
                      <small>Email</small>
                      <p class="mb-0 fw-bold">{{ empty($adoption->user->email) ? "-" : $adoption->user->email }}</p>
                    </div>
                  </div>
                  <div class="d-flex align-items-center" style="gap: 10px">
                    <h4><i class="bi bi-whatsapp"></i></h4>
                    <div>
                      <small>Whatsapp</small>
                      <p class="mb-0 fw-bold">{{ empty($adoption->user->whatsapp) ? "-" : $adoption->user->whatsapp }}</p>
                    </div>
                  </div>
                  @if($adoption->status == 'accepted')
                    <form class="cancel-adoption" action="{{ route('adoptions.update', $adoption->id) }}" method="POST">
                      @csrf
                      @method('PUT')
                      <input type="hidden" name="status" value="cancel">
                      <button type="submit" class="btn btn-custom-submit w-100 btn-cancel-adoption">
                        {{ __('Cancel') }}
                      </button>
                    </form>
                  @else
                    <form id="accept-form" action="{{ route('adoptions.update', $adoption->id) }}" method="POST">
                      @csrf
                      @method('PUT')
                      <input type="hidden" name="status" value="accept">
                      <button type="submit" class="btn btn-custom-submit w-100">
                        {{ __('Accept') }}
                      </button>
                    </form>
                  @endif
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
