@extends('layouts.app')

@section('content')
  <div class="container">
    <img class="step-image" src="{{asset('images/step/step 3.svg')}}" alt="">
    <div class="text-center m-auto my-2 text-base-color">
      <p class="fs-4 m-0">Waiting for approval</p>
      <p class="alert alert-info m-auto mb-3">Monitor the status of your request adoption or contact the dog owner for updates.</p>
    </div>

    <div class="dog-card">
      <div class="brief">
        <div class="wrapper">
          <!-- <a class="cursor-pointer custom-link" data-bs-toggle="modal" data-bs-target="#rescuer_information"> -->
            <h6 class="text-center fw-bold">{{ $dog_owner->first_name }} {{ $dog_owner->last_name }}</h6>
          <!-- </a> -->
          <hr class="mt-1">
          <div class="gender">
            <i class="bi bi-envelope dtl-icon"></i>
            <div>
              <small>Email</small><br/>
              <h6 class="fw-bold">{{ empty($dog_owner->email) ? "not set" : $dog_owner->email }}</h6>
            </div>
          </div>
          <div class="size">
            <i class="bi bi-whatsapp dtl-icon"></i>
            <div>
              <small>Whatsapp</small><br/>
              <h6 class="fw-bold">{{ empty($dog_owner->whatsapp) ? "not set" : $dog_owner->whatsapp }}</h6>
            </div>
          </div>
          <div class="size">
            <i class="bi bi-facebook dtl-icon"></i>
            <div>
              <small>Facebook</small><br/>
              <h6 class="fw-bold">{{ empty($dog_owner->facebook) ? "not set" : $dog_owner->facebook }}</h6>
            </div>
          </div>
          <div class="size">
            <i class="bi bi-instagram dtl-icon"></i>
            <div>
              <small>Instagram</small><br/>
              <h6 class="fw-bold">{{ empty($dog_owner->instagram) ? "not set" : $dog_owner->instagram }}</h6>
            </div>
          </div>
          <div class="size">
            <i class="bi bi-geo-alt dtl-icon"></i>
            <div>
              <small>Location</small><br/>
              <h6 class="fw-bold">{{ empty($dog_owner->street_address) ? "not set" : $dog_owner->street_address }}</h6>
            </div>
          </div>

        </div>
      </div>
    </div>
    <div class="d-flex justify-content-center">
      <a href="{{ route('dog.my_dog.adoption_request') }}" class="btn btn-custom-submit mt-3 m-auto"> See all request</a>
    </div>

  </div>
@endsection
