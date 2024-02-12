@extends('layouts.app')

@section('content')
  <div class="container">
    <h4>Dog detail from {{ $rescuer->first_name.' '.$rescuer->last_name }}</h4>
    <p  class="pb-5">We found {{ $rescued_dogs->count() }} dog(s)</p>

    @include('dogs.partials.dog_list', ['stray_dogs'=> $rescued_dogs]);
  </div>
@endsection
