<div class="main-card d-flex justify-content-between">
  <!-- title -->
  <div>
    <h1 class="fw-bold">{{ __('dog.title') }}</h1>
    <div class="alert alert-info" role="alert">
      {{session('role') =='adopter' ? __('dog.sub_title') : __('dog.sub_title_request')}}
    </div>
    
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