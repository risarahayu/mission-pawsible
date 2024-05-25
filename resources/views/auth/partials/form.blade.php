{{-- Name input --}}
<div class="mb-3">
  <div class="row row-cols-lg-2">
    <div class="col">

      <label class="fw-bold mb-1" for="name"><span class="text-danger">*</span>{{ __('session.first_name') }}</label>
      <input placeholder="{{ __('session.placeholder.first_name') }}" id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name"
        value="@if(session('role')=='admin'){{$user->first_name}}@endif" required autocomplete="first_name" autofocus>
      @error('first_name')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="col">
      <label class="fw-bold mb-1" for="name"><span class="text-danger">*</span>{{ __('session.last_name') }}</label>
      <input placeholder="{{ __('session.placeholder.last_name') }}" id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name"
        value="@if(session('role')=='admin'){{$user->last_name}}@endif" required autocomplete="last_name" autofocus>
      @error('last_name')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
  </div>
</div>
{{-- End of name input --}}

{{-- Email input --}}
<div class="mb-3">
  <label class="fw-bold mb-1" for="email"><span class="text-danger">*</span>{{ __('session.email_address') }}</label>
  <input id="email" placeholder="{{ __('session.placeholder.email') }}" type="email" class="form-control @error('email') is-invalid @enderror"
    name="email" value="@if(session('role')=='admin'){{$user->email}}@endif" required autocomplete="email">
  @error('email')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
  @enderror
</div>
{{-- End of email input --}}

<div class="mb-3">
  <label class="fw-bold mb-1" for="whatsapp"><span class="text-danger">*</span>{{ __('app.profile.whatsapp') }}</label>
  <input id="whatsapp" type="text" name="whatsapp"
          class="form-control @error('whatsapp') is-invalid @enderror"
          autocomplete="whatsapp" placeholder="{{ __('session.placeholder.whatsapp') }}"
          value="@if(session('role')=='admin'){{optional($user->userInfo)->whatsapp}}@endif"
          required>
  @error('whatsapp')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
  @enderror
</div>


@if(session('role')=='admin')
<div class="row">
  <div class="col">
    <div class="form-floating mb-3">
      <select id="area" name="area_id" class="form-select required @error('area') is-invalid @enderror" required>
        <option value="" disabled selected >{{ __('app.profile.choose_one') }}</option>
        @foreach($area as $area)
          <option value="{{ $area->id }}"  {{ optional($user->userInfo)->area_id === $area->id ? 'selected' : '' }} >{{ ucfirst($area->name) }} </option>
        @endforeach
      </select>
      <label for="city"><span class="text-danger">*</span>{{ __('app.profile.city') }}</label>
      @error('city')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
  </div>
  <div class="col">
    <div class="form-floating mb-3">
      <input id="province" type="text" name="province"
              class="form-control @error('province') is-invalid @enderror"
              autocomplete="province" placeholder="{{ __('app.profile.province') }}" readonly="true"
              value="{{ is_null(optional(auth()->user()->userInfo)->province) ? ucfirst("bali") : optional(auth()->user()->userInfo)->province }}">
      <label for="province">{{ __('app.profile.province') }}</label>
      @error('province')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
  </div>
</div>
@endif

@if (empty(session('role')))
  {{-- Password input --}}
  <div class="mb-3">
    <label class="fw-bold mb-1" for="password"><span class="text-danger">*</span>{{ __('session.password') }}</label>
    <input id="password" placeholder="{{ __('session.placeholder.password') }}" type="password" class="form-control @error('password') is-invalid @enderror"
      name="password" required autocomplete="new-password">
    <p class="form-text text-white">Input minimal 8 charachter</p>
    @error('password')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>
  {{-- End of password input --}}

  {{-- Password confirm input --}}
  <div class="mb-3">
    <label class="fw-bold mb-1" for="password-confirm"><span class="text-danger">*</span>{{ __('session.confirm_password') }}</label>
    <input id="password-confirm" placeholder="{{ __('session.placeholder.confirm_password') }}" type="password" class="form-control" name="password_confirmation" required
      autocomplete="new-password">
  </div>
  {{-- End of password confirm input --}}
@endif
