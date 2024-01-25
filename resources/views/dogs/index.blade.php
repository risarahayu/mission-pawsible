@extends('layouts.app')

@section('content')

<section>
  <div class="container">
    <div class="main-card d-flex justify-content-between">

      <!-- title -->
      <div>
        <h1 class="fw-bold">{{ __('dog.title') }}</h1>
        @if(!empty($area_name))
          <p class="m-0">{{ __('dog.index.count', ['count'=>$stray_dogs->count(), 'area'=> $area_name]) }}
        @else
          <p class="m-0">{{ __('dog.index.all_count', ['count'=>$stray_dogs->count()]) }}
        @endif
      </div>

      <div class="filter-search">
        <!-- sort -->
        <div class="dropdown">
          <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-filter me-2"></i>{{ __('dog.index.filter') }}
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('dogs.index') }}">{{ __('dog.index.all') }}</a></li>
            @foreach (['badung', 'bangli', 'buleleng', 'gianyar', 'jembrana', 'karangasem', 'klungkung', 'tabanan', 'denpasar'] as $area)
              <li><a class="dropdown-item" href="{{ route('dogs.index', ['area' => $area]) }}">{{ ucfirst($area) }}</a></li>
            @endforeach
          </ul>
        </div>

        @if (false)
          <!-- search -->
          <form action="/search/stray_dog" method="GET" class="input-group" style="max-width: 300px; height: fit-content;">
            @csrf <!-- Add CSRF token -->
            <input type="search" name="search" class="form-control" placeholder="Search">
            <span class="input-group-text" id="basic-addon2"><i class="bi bi-search"></i></span>
          </form>
        @endif
      </div>

    </div>
  </div>
</section>

<section>
  <div class="container">
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
                  <h5 class="position-absolute bg-info-subtle p-2 m-2 rounded fs-6">Adoptable</h5>
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
                        <h6 class="fw-bold m-0">{{$stray_dog->area->name}}</h6>
                      </div>
                    </div>
                    <div class="size request-time">
                      <div>
                        <!-- <small><i class="bi bi-person" style="margin-right: 15px"></i> {{__('dog.index.request_by', ['count' => $stray_dog->adoptions->count()])}}</small><br/> -->
                        <small class=" m-0"><i class="bi bi-clock-history" style="margin-right: 15px"></i>{{ __('dog.index.since', ['date' => $stray_dog->created_at->format('Y-m-d')]) }}</small>
                      </div>
                    </div>
                    <div class="button mt-1">
                      <!-- @php
                        $dog_status = ($stray_dog->adopted) ? "adopted" : "adopteable";
                        $status = ($stray_dog->adopted) ? __('dog.index.adopted') : __('dog.index.adoptable');
                      @endphp -->

                      <a href="{{ route('dogs.show', ['dog' => $stray_dog->id]) }}" class="btn btn-custom-submit w-100">
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
  </div>
</section>
@endsection
