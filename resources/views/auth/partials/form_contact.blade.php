<div class="row row-cols-2">
  <div class="col">
    <div class="form-floating mb-3">
      <input id="first_name" type="text" name="first_name"
              class="form-control required @error('first_name') is-invalid @enderror"
              autocomplete="first_name" placeholder="{{ __('first_name') }}"
              value="{{ auth()->user()->first_name }}"
              required>
      <label for="first_name">{{ __('first_name') }}</label>
      @error('first_name')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
  </div>
  <div class="col">
    <div class="form-floating mb-3">
      <input id="last_name" type="text" name="last_name"
              class="form-control required @error('last_name') is-invalid @enderror"
              autocomplete="last_name" placeholder="{{ __('last_name') }}"
              value="{{ auth()->user()->last_name }}"
              required>
      <label for="last_name">{{ __('last_name') }}</label>
      @error('last_name')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
  </div>
</div>

<div class="form-floating mb-3">
  <input id="birthday" type="date" name="birthday"
          class="form-control @error('birthday') is-invalid @enderror"
          autocomplete="birthday" placeholder="{{ __('birthday') }}"
          value="{{ optional(auth()->user()->userInfo)->birthday }}">
  <label for="birthday">{{ __('birthday') }}</label>
  @error('birthday')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
  @enderror
</div>

<div class="form-floating mb-3">
  <input id="whatsapp" type="text" name="whatsapp"
          class="form-control @error('whatsapp') is-invalid @enderror"
          autocomplete="whatsapp" placeholder="{{ __('whatsapp') }}"
          value="{{ optional(auth()->user()->userInfo)->whatsapp }}">
  <label for="whatsapp">{{ __('whatsapp') }}</label>
  @error('whatsapp')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
  @enderror
</div>

<div class="form-floating mb-3">
  <input id="facebook" type="text" name="facebook"
          class="form-control @error('facebook') is-invalid @enderror"
          autocomplete="facebook" placeholder="{{ __('facebook') }}"
          value="{{ optional(auth()->user()->userInfo)->facebook }}">
  <label for="facebook">{{ __('facebook') }}</label>
  @error('facebook')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
  @enderror
</div>

<div class="form-floating mb-3">
  <input id="instagram" type="text" name="instagram"
          class="form-control @error('instagram') is-invalid @enderror"
          autocomplete="instagram" placeholder="{{ __('instagram') }}"
          value="{{ optional(auth()->user()->userInfo)->instagram }}">
  <label for="instagram">{{ __('instagram') }}</label>
  @error('instagram')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
  @enderror
</div>

<div class="form-floating mb-3">
  <input id="street_address" type="text" name="street_address"
          class="form-control @error('street_address') is-invalid @enderror"
          autocomplete="street_address" placeholder="{{ __('street_address') }}"
          value="{{ optional(auth()->user()->userInfo)->street_address }}">
  <label for="street_address">{{ __('street_address') }}</label>
  @error('street_address')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
  @enderror
</div>

<div class="row">
  <div class="col">
    <div class="form-floating mb-3">
      <input id="city" type="text" name="city"
              class="form-control @error('city') is-invalid @enderror"
              autocomplete="city" placeholder="{{ __('city') }}"
              value="{{ optional(auth()->user()->userInfo)->city }}">
      <label for="city">{{ __('city') }}</label>
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
              autocomplete="province" placeholder="{{ __('province') }}"
              value="{{ optional(auth()->user()->userInfo)->province }}">
      <label for="province">{{ __('province') }}</label>
      @error('province')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
  </div>
  <div class="col">
    <div class="form-floating mb-3">
      <input id="postal" type="text" name="postal" pattern="\d*" maxlength="8"
              class="form-control @error('postal') is-invalid @enderror"
              autocomplete="postal" placeholder="{{ __('postal') }}"
              value="{{ optional(auth()->user()->userInfo)->postal }}">
      <label for="postal">{{ __('postal') }}</label>
      @error('postal')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
  </div>
</div>