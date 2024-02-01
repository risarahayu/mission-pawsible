
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
          <h6 class="fw-bold">{{ empty($user->userInfo->whatsapp) ? "not set" : $user->userInfo->whatsapp }}</h6>
        </div>
      </div>
    </div>
  </div>
</div>