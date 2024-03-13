
<div class="dog-card mb-3">
  <div class="brief">
    <div class="wrapper">
      <!-- <a class="cursor-pointer custom-link" data-bs-toggle="modal" data-bs-target="#rescuer_information"> -->
        <h6 class="text-center fw-bold">{{ $user->first_name }} {{ $user->last_name }}</h6>
        <p></p>
      <!-- </a> -->
      <hr class="mt-1">
      <div class="gender">
        <i class="bi bi-envelope dtl-icon"></i>
        <div>
          <small>Email</small><br/>
          <h6 class="fw-bold text-break">{{ empty($user->email) ? "not set" : $user->email }}</h6>
        </div>
      </div>
      <div class="size">
        <i class="bi bi-whatsapp dtl-icon"></i>
        <div>
          <small>Whatsapp</small><br/>
          @php
            $whatsapp = empty($user->userInfo->whatsapp) ? "not set" : $user->userInfo->whatsapp;
            if($whatsapp == 'not set') {
              $whatsapp_link = '#';
            } else {
              $text = urlencode("Halo, saya ingin menerima bantuan untuk rescue!");
              $whatsapp_link = "https://wa.me/62{$whatsapp}?text={$text}";
            };
          @endphp
          <a href="{{ $whatsapp_link }}" class="h6 fw-bold">{{ $whatsapp }}</a>
        </div>
      </div>
      <div class="size">
        <i class="fa-solid fa-shield-dog"></i>
        <div>
          <small>Rescue</small><br/>
          <a href="{{route('admins.rescuer.detail', ['rescuer_id'=>$user->id])}}">
            <h6 class="fw-bold">{{ __('rescue.dog_count', ['count' => $user->rescuedDogs->count()]) }}</h6>
          </a>
        </div>
      </div>
      <div class="size">
        <i class="bi bi-geo-alt"></i>
        <div>
          <small>Location</small><br/>
            <h6 class="fw-bold">{{ ucfirst(optional(optional($user->userInfo)->area)->name) }}</h6>
          </a>
        </div>
      </div>

      @if(session('role') == 'admin')
        <div class="row">
          <div class="col-6">
            <a href="{{ route('admins.edit', $user->id) }}" class="btn btn-primary w-100"><i class="bi bi-pencil-square me-2"></i> Edit</a>
          </div>

          <div class="col-6">
            <form action="{{ route('admins.destroy', ['admin' => $user->id]) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="button" class="btn btn-danger need-confirm w-100">
                <i class="bi bi-trash me-2"></i> {{ __('app.button.delete') }}
              </button>
            </form>
          </div>
        </div>
      @endif
    </div>
  </div>
</div>
