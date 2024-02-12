@extends('layouts.app')

@section('content')
  <section>
    <div class="container">
      @include('dogs.partials.main_card', ['area_name' => $area_name])
    </div>
  </section>

  <section>
    <div class="container">
      @include('dogs.partials.dog_list', ['stray_dog' => $stray_dogs])
    </div>
  </section>
@endsection
