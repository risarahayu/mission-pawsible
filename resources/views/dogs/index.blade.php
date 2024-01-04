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
    <div class="row">
      @if ($stray_dogs->isNotEmpty())
        @foreach($stray_dogs as $stray_dog)
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
                        <small>Gender</small><br/>
                        <h4 class="fw-bold">{{ ucfirst($stray_dog->gender) }}</h4>
                      </div>
                    </div>
                    <div class="size">
                      <img class="dtl-icon" src="{{ asset('images/cil_animal.png') }}">
                      <div>
                        <small>Size</small><br/>
                        <h4 class="fw-bold">{{ ucfirst($stray_dog->size) }}</h4>
                      </div>
                    </div>
                    <div class="size request-time">
                      <i class="bi bi-clock-history dtl-icon"></i>
                      <div>
                        <small>Request by {{$stray_dog->adoptions_count}} people</small><br/>
                        <h4 class="fw-bold">Since {{ $stray_dog->created_at->format('Y-m-d') }}</h4>
                      </div>
                    </div>
                    <div class="button">
                      @php
                        $dog_status = ($stray_dog->adopted) ? 'Adopted' : 'Adopteable';
                      @endphp
                      <a href="{{ route('dogs.show', ['dog' => $stray_dog->id]) }}" class="btn btn-custom-submit w-100 btn-{{ strtolower($dog_status) }}">
                        {{ $dog_status }}
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
