
<div class="dog-card">
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
    </div>
  </div>
</div>
