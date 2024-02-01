
<div id="carouselExampleIndicators" class="dog-picture-wrapper carousel slide" data-bs-ride="true">
  <div class="carousel-indicators">
    @foreach ($stray_dog->images()->orderBy('category')->get() as $index => $image)
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $index }}" class="@if($index === 0) active @endif" aria-current="true" aria-label="Slide {{ $index }}"></button>
    @endforeach
  </div>
  <div class="carousel-inner">
    @foreach ($stray_dog->images()->orderBy('category')->get() as $index => $image)
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
