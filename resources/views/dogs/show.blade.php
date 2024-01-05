@extends('layouts.app')

@section('content')
  <!-- Dog information -->
  <section id="dog_information">
    <div class="container">

      <!-- Dog information title -->
      <div class="main-card text-center">
        <h3 class="fw-bold m-1">{{ __('dog.show.title') }}</h3>
      </div>

      <!-- Dog information detail -->
      <div class="row flex-lg-row flex-column-reverse">

        <div class="col-lg-6 dog-show">
          
          <div class="main-card">
            <!-- Action button -->
            <div class="d-flex justify-content-end" style="gap: 5px;">
              @if(Auth::id()==$stray_dog->user_id)
                <a type="button" class="btn btn-mps" href="{{ route('dogs.edit', $stray_dog->id) }}"><i class="bi bi-pencil-square me-2"></i> {{ __('app.button.edit') }}</a>
                @if (!$stray_dog->adopted)
                  <form action="{{ route('dogs.destroy', $stray_dog->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                  </form>
                  <button class="btn btn-danger delete-dog">
                    <i class="bi bi-trash me-2"></i> {{ __('app.button.delete') }}
                  </button>
                @endif
              @else
                @if (!$stray_dog->adopted && $user->adoptions->where('dog_id', $stray_dog->id)->isEmpty())
                  <a type="button" class="btn btn-mps" href="{{ route('adoptions.create', ['dog' => $stray_dog->id]) }}">
                    <i class="fa-solid fa-hand-holding-heart me-2"></i> {{ __('app.button.adopt') }}
                  </a>
                @endif
              @endif
            </div>

            <!-- Dog details -->
            @include('dogs.partials.dog_detail')
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
              @endif
            @endif
          </div>
        </div>

        <div class="col-lg-6 text-center position-relative">
          <!-- Dog picture carousel -->
          @include('dogs.partials.dog_carousel')
        </div>
      </div>
    </div>
  </section>

  <!-- Adoption infromation -->
  @if(Auth::id() == $own->id)
    <section id="dog_adoption">
      <div class="container">

        @if ($adoptions->count() > 0)
          <!-- Dog information title -->
          <div class="main-card text-center mt-4">
            <h3 class="fw-bold m-1">{{ __('Adopters') }}</h3>
          </div>

          <div class="row">
            @foreach ($adoptions as $adoption)
              <div class="col-md-4">
                <div class="dog-card">
                  <div class="brief">
                    <div class="wrapper">

                      <h4 class="text-center fw-bold">{{ $adoption->user->first_name }} {{ $adoption->user->last_name }}</h4>
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
