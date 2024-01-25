@extends('layouts.app')

@section('content')

  <section>
    <div class="container">
    <h4 class="">My Adoption Request</h4>
    <p class="mb-5">We found {{$count}} dog(s)</p>
      <div class="row">
        @if ($adoptions->isNotEmpty())
          @foreach($adoptions as $stray_dog)
            <div class="col-lg-6 mb-4">
              <div class="dog-card">
                <div class="row">
                  <div class="col-sm-6 image-wrapper">
                  <h5 class="position-absolute bg-info-subtle p-2 m-2 rounded fs-6">
                    @php
                      $dog_status = ($stray_dog->dog->adopted) ? "adopted" : "adopteable";
                      $status = ($stray_dog->dog->adopted) ? __('dog.index.adopted') : __('dog.index.pending');
                      $cek = ($stray_dog->user_id == auth()->user()->id) ? '<i class="bi bi-check-circle"></i> you get' : 'adopted';
                    @endphp
                    {!! $cek !!}
                  </h5>
                    @php
                      $filename = $stray_dog->dog->images()->orderBy('category')->first()->filename;
                      $filename = explode('/', $filename);
                      $filename = end($filename);
                    @endphp
                    <img src="{{ asset($stray_dog->dog->images()->orderBy('category')->first()->filename) }}" alt="{{ $filename }}">
                  </div>
                  <div class="col-sm-6 brief">
                    <div class="wrapper">
                      <div class="gender">
                        <i class="bi bi-gender-ambiguous dtl-icon"></i>
                        <div>
                          <small>{{ __('dog.form.gender') }}</small><br/>
                          <h6 class="fw-bold">{{ __(ucfirst($stray_dog->dog->gender)) }}</h6>
                        </div>
                      </div>
                      <div class="size">
                        <img class="dtl-icon" src="{{ asset('images/cil_animal.png') }}">
                        <div>
                          <small>{{ __('dog.form.size') }}</small><br/>
                          @php $dog_size = $stray_dog->dog->size @endphp
                          <h6 class="fw-bold">{{ __("dog.form.option.$dog_size") }}</h6>
                        </div>
                      </div>
                      <!-- <div class="size request-time">
                        <i class="bi bi-clock-history dtl-icon"></i>
                        <div>
                          <small>{{__('dog.index.request_by', ['count' => $stray_dog->count()])}}</small><br/>
                          <h6 class="fw-bold">{{ __('dog.index.since', ['date' => $stray_dog->created_at->format('Y-m-d')]) }}</h6>
                        </div>
                      </div> -->
                      <div class="size">
                      <i class="bi bi-geo-alt"></i>
                      <div>
                        <small>{{ __('dog.form.district') }}</small><br/>
                        <h6 class="fw-bold m-0">{{$stray_dog->dog->area->name}}</h6>
                      </div>
                    </div>
                    <div class="size request-time border-top pt-2">
                      <div>
                        <small><i class="bi bi-person" style="margin-right: 15px"></i> {{__('dog.index.request_by', ['count' => $stray_dog->count()])}}</small><br/>
                        <small class=" m-0"><i class="bi bi-clock-history" style="margin-right: 15px"></i>{{ __('dog.index.since', ['date' => $stray_dog->created_at->format('Y-m-d')]) }}</small>
                      </div>
                    </div>
                      <div class="button">
                        <a href="{{ route('dogs.show', ['dog' => $stray_dog->dog->id]) }}" class="btn btn-custom-submit w-100">
                          {{ __('dog.index.see_detail')}}
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
                <!-- <p class="m-0 mt-2 txt-1">{{ __('dog.index.empty') }}</p> -->
                <p class="m-0 txt-2"><i class="bi bi-plus-square-dotted me-3"></i>{{ __('dog.index.empty_adopted_dog') }}</p>
              </div>
            </a>
          </div>
        @endif
      </div>
    </div>
  </section>
@endsection