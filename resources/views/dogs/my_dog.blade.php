@extends('layouts.app')

@section('content')
    <section>
      <div class="container">
      <h4>My Adoption Request</h4>
        <div class="row">
          @if ($adoptions->isNotEmpty())
            @foreach($adoptions as $stray_dog)
              <div class="col-lg-6 mb-4">
                <div class="dog-card">
                  <div class="row">
                    <div class="col-sm-6 image-wrapper">
                      @php
                        $filename = $stray_dog->dog->images()->orderBy('category')->first()->filename;
                        $filename = explode('/', $filename);
                        $filename = end($filename);
                      @endphp
                      <img src="{{ asset($stray_dog->dog->images()->orderBy('category')->first()->filename) }}" alt="{{ $filename }}">
                    </div>
                    <div class="col-sm-6 brief">
                      <div class="wrapper">
                        <div class="gender">
                          <i class="bi bi-gender-ambiguous dtl-icon"></i>
                          <div>
                            <small>{{ __('dog.form.gender') }}</small><br/>
                            <h4 class="fw-bold">{{ __(ucfirst($stray_dog->dog->gender)) }}</h4>
                          </div>
                        </div>
                        <div class="size">
                          <img class="dtl-icon" src="{{ asset('images/cil_animal.png') }}">
                          <div>
                            <small>{{ __('dog.form.size') }}</small><br/>
                            @php $dog_size = $stray_dog->dog->size @endphp
                            <h4 class="fw-bold">{{ __("dog.form.option.$dog_size") }}</h4>
                          </div>
                        </div>
                        <div class="size request-time">
                          <i class="bi bi-clock-history dtl-icon"></i>
                          <div>
                            <small>{{__('dog.index.request_by', ['count' => $stray_dog->count()])}}</small><br/>
                            <h4 class="fw-bold">{{ __('dog.index.since', ['date' => $stray_dog->created_at->format('Y-m-d')]) }}</h4>
                          </div>
                        </div>
                        <div class="button">
                          @php
                            $dog_status = ($stray_dog->adopted) ? "adopted" : "adopteable";
                            $status = ($stray_dog->adopted) ? __('dog.index.adopted') : __('dog.index.pending');
                          @endphp
                          <a href="{{ route('dogs.show', ['dog' => $stray_dog->id]) }}" class="btn btn-custom-submit w-100 btn-{{ strtolower($dog_status) }}">
                            {{ $status }}
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
                  <!-- <p class="m-0 mt-2 txt-1">{{ __('dog.index.empty') }}</p> -->
                  <p class="m-0 txt-2"><i class="bi bi-plus-square-dotted me-3"></i>{{ __('dog.index.empty_adopted_dog') }}</p>
                </div>
              </a>
            </div>
          @endif
        </div>
      </div>
    </section>

  <!-- My Rescued Dog -->
  <section>
    <div class="container">
    <h4>My Rescued Dog</h4>
      <div class="row">
        @if ($rescues->isNotEmpty())
          @foreach($rescues as $stray_dog)
            <div class="col-lg-6 mb-4">
              <div class="dog-card">
                <div class="row">
                  <div class="col-sm-6 image-wrapper">
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
                          <h4 class="fw-bold">{{ __(ucfirst($stray_dog->gender)) }}</h4>
                        </div>
                      </div>
                      <div class="size">
                        <img class="dtl-icon" src="{{ asset('images/cil_animal.png') }}">
                        <div>
                          <small>{{ __('dog.form.size') }}</small><br/>
                          <h4 class="fw-bold">{{ __("dog.form.option.$stray_dog->size") }}</h4>
                        </div>
                      </div>
                      <div class="size request-time">
                        <i class="bi bi-clock-history dtl-icon"></i>
                        <div>
                          <small>{{__('dog.index.request_by', ['count' => $stray_dog->count()])}}</small><br/>
                          <h4 class="fw-bold">{{ __('dog.index.since', ['date' => $stray_dog->created_at->format('Y-m-d')]) }}</h4>
                        </div>
                      </div>
                      <div class="button">
                        @php
                          $dog_status = ($stray_dog->adopted) ? "adopted" : "adopteable";
                          $status = ($stray_dog->adopted) ? __('dog.index.adopted') : __('dog.index.adoptable');
                        @endphp
                        <a href="{{ route('dogs.show', ['dog' => $stray_dog->id]) }}" class="btn btn-custom-submit w-100 btn-{{ strtolower($dog_status) }}">
                          {{ $status }}
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
                <!-- <p class="m-0 mt-2 txt-1">{{ __('dog.index.empty') }}</p> -->
                <p class="m-0 txt-2"><i class="bi bi-plus-square-dotted me-3"></i>{{ __('dog.index.empty_rescued_dog') }}</p>
              </div>
            </a>
          </div>
        @endif
      </div>
    </div>
  </section>

  <!-- My Registered Dog -->
  <section>
    <div class="container">
    <h4>My Registered Dog</h4>
      <div class="row">
        @if ($myDogs->isNotEmpty())
          @foreach($myDogs as $stray_dog)
            <div class="col-lg-6 mb-4">
              <div class="dog-card">
                <div class="row">
                  <div class="col-sm-6 image-wrapper">
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
                          <h4 class="fw-bold">{{ __(ucfirst($stray_dog->gender)) }}</h4>
                        </div>
                      </div>
                      <div class="size">
                        <img class="dtl-icon" src="{{ asset('images/cil_animal.png') }}">
                        <div>
                          <small>{{ __('dog.form.size') }}</small><br/>
                          <h4 class="fw-bold">{{ __("dog.form.option.$stray_dog->size") }}</h4>
                        </div>
                      </div>
                      <div class="size request-time">
                        <i class="bi bi-clock-history dtl-icon"></i>
                        <div>
                          <small>{{__('dog.index.request_by', ['count' => $stray_dog->count()])}}</small><br/>
                          <h4 class="fw-bold">{{ __('dog.index.since', ['date' => $stray_dog->created_at->format('Y-m-d')]) }}</h4>
                        </div>
                      </div>
                      <div class="button">
                        @php
                          $dog_status = ($stray_dog->adopted) ? "adopted" : "adopteable";
                          $status = ($stray_dog->adopted) ? __('dog.index.adopted') : __('dog.index.adoptable');
                        @endphp
                        <a href="{{ route('dogs.show', ['dog' => $stray_dog->id]) }}" class="btn btn-custom-submit w-100 btn-{{ strtolower($dog_status) }}">
                          {{ $status }}
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
                <!-- <p class="m-0 mt-2 txt-1">{{ __('dog.index.empty') }}</p> -->
                <p class="m-0 txt-2"><i class="bi bi-plus-square-dotted me-3"></i>{{ __('dog.index.register') }}</p>
              </div>
            </a>
          </div>
        @endif
      </div>
    </div>
  </section>

@endsection
