@extends('layouts.app')

@section('content')

  <section>
    <div class="container pb-5">
      <h4 class="">My Adoption Request</h4>
      <p class="mb-5">We found {{$count}} dog(s)</p>
        @include('dogs.partials.dog_card')
    </div>

    <div class="container pt-5">
      <h4 class="">My Adoption Request History</h4>
      <p class="mb-5">We found {{$history_count}} dog(s)</p>
      <div class="row">
        @include('dogs.partials.dog_card' , ['adoptions' => $history])
      </div>
    </div>
  </section>
@endsection