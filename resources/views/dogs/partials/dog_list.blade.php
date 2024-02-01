<!-- button -->
@if (session('role') == 'rescuer')
  <a class="btn btn-custom-submit mb-3" href="{{ route('requests.create') }}"><i class="fa-solid fa-circle-plus" ></i> {{ __('nav.request') }}</a>
@else
  <a class="btn btn-custom-submit mb-3" href="{{ route('dogs.create') }}"><i class="fa-solid fa-circle-plus"></i> {{ __('nav.register') }}</a>
@endif
<div class="row">
  @if ($stray_dogs->isNotEmpty())
    @foreach($stray_dogs as $stray_dog)
      <div class="col-lg-6 mb-4">
        <div class="dog-card">
          <div class="row">
            <div class="col-sm-6 image-wrapper">
              <!-- card status -->
              @if (session('role') == 'adopter')
                @if ($stray_dog->adopted == false)
                  @if($stray_dog->where('user_id', '!=', auth()->user()->id)->first())
                    <h5 class="position-absolute bg-info-subtle p-2 m-2 rounded fs-6">
                      Adoptable
                    </h5>
                  @endif
                  @if(!$stray_dog->adoptions->where('user_id', '=', auth()->user()->id)->first())
                      <h5 class="position-absolute bg-info-subtle p-2 m-2 rounded fs-6">
                          Waiting for potential adopter
                      </h5>
                  @endif

                  
                  @if ($stray_dog->adoptions->where('status', 'pending')->where('user_id', auth()->user()->id)->first())
                  <h5 class="position-absolute bg-info-subtle p-2 m-2 rounded fs-6">
                      <h5 class="position-absolute bg-warning-subtle p-2 m-2 rounded fs-6">
                        <i class="bi bi-exclamation-circle"></i> Waiting for approval
                      </h5>
                    elseif ($stray_dog->adoptions->where('status', 'pending')->where('user_id', '!=', auth()->user()->id)->first())
                      <h5 class="position-absolute bg-info-subtle p-2 m-2 rounded fs-6">
                        Adoptable
                      </h5>
                    @endif
                  @elseif ($stray_dog->dog->adopted == true &&  $stray_dog->where('user_id', auth()->user()->id)->first())
                    <h5 class="position-absolute bg-success-subtle p-2 m-2 rounded fs-6">
                      <i class="bi bi-check-circle"></i> You got this
                    </h5>
                  @else
                    <h5 class="position-absolute bg-danger-subtle p-2 m-2 rounded fs-6">
                      <i class="bi bi-x-circle"> Adopted by other
                    </h5>
                  @endif
                </h5>
              @endif
              @if (session('role') == 'rescuer')
                @if($stray_dog->rescued)
                  <h5 class="position-absolute bg-success-subtle p-2 m-2 rounded fs-6">
                    <i class="bi bi-check-circle"></i> Rescued
                  </h5>
                @else
                  <h5 class="position-absolute bg-warning-subtle p-2 m-2 rounded fs-6">
                     Waiting for rescue
                  </h5>
                @endif
              @endif
              @php
                $filename = $stray_dog->images()->orderBy('category')->first()->filename;
                $filename = explode('/', $filename);
                $filename = end($filename);
              @endphp
              <img src="{{ asset($stray_dog->images()->orderBy('category')->first()->filename) }}" alt="{{ $filename }}">
            </div>
            <div class="col-sm-6 brief">
              <div class="wrapper">
                <div class="gender">
                  <i class="bi bi-gender-ambiguous dtl-icon"></i>
                  <div>
                    <small>{{ __('dog.form.gender') }}</small><br/>
                    <h6 class="fw-bold m-0">{{ __(ucfirst($stray_dog->gender)) }}</h6>
                  </div>
                </div>
                <div class="size">
                  <img class="dtl-icon" src="{{ asset('images/cil_animal.png') }}">
                  <div>
                    <small>{{ __('dog.form.size') }}</small><br/>
                    <h6 class="fw-bold m-0">{{ __("dog.form.option.$stray_dog->size") }}</h6>
                  </div>
                </div>
                <div class="size">
                  <i class="bi bi-geo-alt"></i>
                  <div>
                    <small>{{ __('dog.form.district') }}</small><br/>
                    <h6 class="fw-bold m-0">{{ucfirst($stray_dog->area->name)}}</h6>
                  </div>
                </div>
                <div class="size request-time border-top pt-2">
                  <div>
                    <small><i class="bi bi-person dtl-icon" style="margin-right: 10px"></i>
                      @if (session('role') == 'rescuer'|| 'solo_rescuer')
                        Registered by {{$stray_dog->user->first_name." ".$stray_dog->user->last_name }}
                      @else
                        {{__('dog.index.request_by', ['count' => $stray_dog->adoptions->count()])}}
                      @endif
                    </small><br/>
                    <small class=" m-0"><i class="bi bi-clock-history" style="margin-right: 15px"></i>{{ __('dog.index.since', ['date' => $stray_dog->created_at->format('Y-m-d')]) }}</small>
                  </div>
                </div>
                <div class="button mt-1">
                  <!-- @php
                    $dog_status = ($stray_dog->adopted) ? "adopted" : "adopteable";
                    $status = ($stray_dog->adopted) ? __('dog.index.adopted') : __('dog.index.adoptable');
                  @endphp -->

                  <a href="{{ session('role') == 'rescuer'? route('requests.show', ['request' => $stray_dog->id]) : route('dogs.show', ['dog' => $stray_dog->id]) }}" class="btn btn-custom-submit w-100">
                    {{ __('dog.index.see_detail') }}
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  @else
    <div class="dashboard-nodata-card dogs">
      <a href="{{ route('dogs.create') }}">
        <div class="d-flex flex-column align-items-center">
          <img src="{{ asset('images/single-dog.png') }}" alt="Single Dog" width="6rem">
          <p class="m-0 mt-2 txt-1">{{ __('dog.index.empty') }}</p>
          <p class="m-0 txt-2"><i class="bi bi-plus-square-dotted me-3"></i>{{ __('dog.index.register') }}</p>
        </div>
      </a>
    </div>
  @endif
</div>