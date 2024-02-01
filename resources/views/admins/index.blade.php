@extends('layouts.app')

@section('content')
  <section>
      <div class="container pb-5">
        <h4 class="">Solo Rescuer List</h4>
        <p class="">We found {{$count}} rescuer(s)</p>
          <a class="btn btn-custom-submit mb-3" href="{{ route('admins.create') }}"><i class="fa-solid fa-circle-plus"></i> {{ __('nav.register_solo_rescuer') }}</a>
        <p class="mb-5"></p>
          <div class="row">
            @foreach($users as $user)
              <div class="col-md-4">
                @include('admins.partials.rescuer_card')
              </div>
            @endforeach
          </div>
      </div>
  </section>
@endsection