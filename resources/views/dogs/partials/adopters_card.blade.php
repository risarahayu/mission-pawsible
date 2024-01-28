
<div class="dog-card">
  <div class="brief">
    <div class="wrapper">
      <!-- <a class="cursor-pointer custom-link" data-bs-toggle="modal" data-bs-target="#rescuer_information"> -->
        <h6 class="text-center fw-bold">{{ $adoption->user->first_name }} {{ $adoption->user->last_name }}</h6>
      <!-- </a> -->
      <hr class="mt-1">
      <div class="gender">
        <i class="bi bi-envelope dtl-icon"></i>
        <div>
          <small>Email</small><br/>
          <h6 class="fw-bold text-break">{{ empty($adoption->user->email) ? "not set" : $adoption->user->email }}</h6>
        </div>
      </div>
      <div class="size">
        <i class="bi bi-whatsapp dtl-icon"></i>
        <div>
          <small>Whatsapp</small><br/>
          <h6 class="fw-bold">{{ empty($adoption->user->whatsapp) ? "not set" : $adoption->user->whatsapp }}</h6>
        </div>
      </div>
      <div class="size">
        <i class="bi bi-facebook dtl-icon"></i>
        <div>
          <small>Facebook</small><br/>
          <h6 class="fw-bold">{{ empty($adoption->user->facebook) ? "not set" : $adoption->user->facebook }}</h6>
        </div>
      </div>
      <div class="size">
        <i class="bi bi-instagram dtl-icon"></i>
        <div>
          <small>Instagram</small><br/>
          <h6 class="fw-bold">{{ empty($adoption->user->instagram) ? "not set" : $adoption->user->instagram }}</h6>
        </div>
      </div>
      <div class="size">
        <i class="bi bi-geo-alt dtl-icon"></i>
        <div>
          <small>Location</small><br/>
          <h6 class="fw-bold">{{ empty($adoption->user->street_address) ? "not set" : $adoption->user->street_address }}</h6>
        </div>
      </div>
      <a class="btn btn-submit-custom-border" data-bs-toggle="modal" data-bs-target="#rescuer_information">
        <h6 class="mb-0 text-center fw-bold">See Detail</h6>
      </a>
    </div>
  </div>
</div>