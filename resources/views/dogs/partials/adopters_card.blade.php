
<div class="dog-card">
  <div class="brief">
    <div class="wrapper">
      <h6 class="text-center fw-bold">{{ $user->first_name }} {{ $user->last_name }}</h6>
      
      @if ($with_potential && $controller_name != 'adoption')
        <div class="progress position-relative" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
          <div class="progress-bar" style="width: {{ $adoption->score }}%">{{ $adoption->score }}% {{ __('app.profile.potential') }}</div>
        </div>
      @endif

      <hr class="mt-1">

      <div class="gender">
        <i class="bi bi-envelope dtl-icon"></i>
        <div>
          <small>{{ __('app.profile.email') }}</small><br/>
          <h6 class="fw-bold text-break">{{ empty($user->email) ? "not set" : $user->email }}</h6>
        </div>
      </div>

      <div class="size">
        <i class="bi bi-whatsapp dtl-icon"></i>
        <div>
          <small>{{ __('app.profile.whatsapp') }}</small><br/>
          @php
            $whatsapp = empty($user->userInfo->whatsapp) ? "not set" : $user->userInfo->whatsapp;
            if($whatsapp == 'not set') {
              $whatsapp_link = '#';
            } else {
              $text = urlencode("Halo, saya ingin berdiskusi untuk pengadopsian anjing!");
              $whatsapp_link = "https://wa.me/62{$whatsapp}?text={$text}";
            };
          @endphp
          <a href="{{ $whatsapp_link }}" class="h6 fw-bold">{{ $whatsapp }}</a>
        </div>
      </div>

      <div class="size">
        <i class="bi bi-facebook dtl-icon"></i>
        <div>
          <small>{{ __('app.profile.facebook') }}</small><br/>
          <h6 class="fw-bold">{{ empty($user->userInfo->facebook) ? "not set" : $user->userInfo->facebook }}</h6>
        </div>
      </div>

      <div class="size">
        <i class="bi bi-instagram dtl-icon"></i>
        <div>
          <small>{{ __('app.profile.instagram') }}</small><br/>
          <h6 class="fw-bold">{{ empty($user->userInfo->instagram) ? "not set" : $user->userInfo->instagram }}</h6>
        </div>
      </div>

      <div class="size">
        <i class="bi bi-geo-alt dtl-icon"></i>
        <div>
          <small>{{ __('app.profile.location') }}</small><br/>
          <h6 class="fw-bold">{{ empty($user->userInfo->street_address) ? "" : $user->userInfo->street_address }}</h6>
          <h6 class="fw-bold">{{ empty($user->userInfo->area_id) ? "not set" : ucfirst($user->userInfo->area->name) }}</h6>
        </div> 
      </div>

      <div class="size">
        <!-- menghitung umur -->
        @php
            // Tanggal lahir dari database
            $birthday = $user->userInfo->birthday;
            
            // Mengonversi tanggal lahir menjadi timestamp
            $birthdate = strtotime($birthday);
            
            // Mendapatkan tanggal hari ini
            $currentDate = strtotime(date('Y-m-d'));
            
            // Menghitung umur
            $age = date('Y', $currentDate) - date('Y', $birthdate);
            
            // Periksa apakah sudah ulang tahun atau belum pada tahun ini
            if (date('md', $currentDate) < date('md', $birthdate)) {
                $age--;
            }
        @endphp
        @if($with_potential && $controller_name != 'adoption')
          <i class="bi bi-person-fill"></i>
          <div>
            <small>{{ __('app.profile.age') }}</small><br/>
            <h6 class="fw-bold">{{$age}} {{ __('app.profile.old') }}</h6>
          </div>
        @endif
      </div>

      @if ($with_potential && $controller_name != 'adoption')
        <a class="btn btn-submit-custom-border" data-bs-toggle="modal" data-bs-target="#rescuer_information_{{ $adoption->id }}">
          <h6 class="mb-0 text-center fw-bold">{{ __('app.button.see_detail') }}</h6>
        </a>
      @endif
    </div>
  </div>
</div>
