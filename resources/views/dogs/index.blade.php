@extends('layouts.app')

@section('content')
<section>
  <div class="container">
    <div class="d-flex justify-content-between flex-wrap mt-3 mb-5">
      <div>
        <h1 class="fw-bold">{{ __('Stray Dog List') }}</h1>
        <p>We found <span class="fw-semibold">{{$stray_dogs->count()}} 
          at
          @if(!empty($area_name))
            {{$area_name}}
          @else
            <span>All</span>
          @endif
        </span> stray dog</p>
      </div>
       <!-- search -->
       <form action="/search/stray_dog" method="GET" class="input-group mb-3" style="max-width: 300px; height: fit-content;">
        @csrf <!-- Add CSRF token -->
        <input type="search" name="search" class="form-control" placeholder="Search">
        <span class="input-group-text" id="basic-addon2"><i class="bi bi-search"></i></span>
      </form>
      <!-- sort -->
      <div class="dropdown">
        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-filter me-2"></i>Filter
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="{{ route('dogs.index') }}">All</a></li>
          @foreach($area as $areaItem)
            <li><a class="dropdown-item" href="{{-- route('straydogs.sort', ['area_name' => $areaItem->name]) --}}">{{ $areaItem->name }}</a></li>
          @endforeach 
        </ul>
      </div>
      
    </div>
  </div>
</section>


<section>
  <div class="container">
    <div class="row">
      @if ($stray_dogs->isNotEmpty())        
        @foreach($stray_dogs as $stray_dog)
          <div class="col-md-4 mb-3">
            <a href="{{ route('dogs.show', ['dog' => $stray_dog->id]) }}" class="dog-link">
              <div class="card dog-list">
                <div class="card-body">
                  <div class="row mb-3">
                    <div class="col-5">
                      <div class="dog-picture">
                        <img class="rounded" src="{{ asset($stray_dog->images->first()->filename) }}" alt="Stray Dog Image">
                      </div>
                    </div>
                    <div class="col-7 d-flex flex-column justify-content-center dog-brief">
                      <div class="d-flex align-items-center" style="gap: 15px;">
                        <i class="bi bi-gender-ambiguous dtl-icon"></i>
                        <div>
                          <small>Gender</small><br/>
                          <h4 class="fw-bold">{{ ucfirst($stray_dog->gender) }}</h4>
                        </div>
                      </div>
                      <div class="d-flex align-items-center" style="gap: 15px;">
                        <img class="dtl-icon" src="{{ asset('images/cil_animal.png') }}">
                        <div>
                          <small>Size</small><br/>
                          <h4 class="fw-bold">{{ ucfirst($stray_dog->size) }}</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row adoption-status flex-column-reverse flex-xl-row">
                    <div class="col-xl-5 d-flex align-items-center">
                      @php
                        $dog_status = ($stray_dog->adopted) ? 'Adopted' : 'Adopteable';
                      @endphp
                      <button type="button" class="btn btn-custom-submit w-100 btn-{{ strtolower($dog_status) }}">
                        {{ $dog_status }}
                      </button>
                    </div>
                    <div class="col-xl-7">
                      <small class="fw-bold">Request by {{$stray_dog->adoptions_count}} people</small><br/>
                      <small>Since {{ $stray_dog->created_at->format('Y-m-d') }}</small>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
        @endforeach
      @else
        <div class="dashboard-nodata-card dogs">
          <a href="{{ route('dogs.create') }}">
            <div class="d-flex flex-column align-items-center">
              <img src="{{ asset('images/single-dog.png') }}" alt="Single Dog" width="6rem">
              <p class="m-0 mt-2 txt-1">No stray dog yet</p>
              <p class="m-0 txt-2"><i class="bi bi-plus-square-dotted me-3"></i>Register a found stray dog</p>
            </div>
          </a>
        </div>
      @endif
    </div>
  </div>
</section>
@endsection
