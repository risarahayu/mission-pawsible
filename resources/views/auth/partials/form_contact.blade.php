<div class="row row-cols-2">
  <div class="col">
    <div class="form-floating mb-3">
      <input id="first_name" type="text" name="first_name"
              class="form-control required @error('first_name') is-invalid @enderror"
              autocomplete="first_name" placeholder="{{ __('app.profile.first_name') }}"
              value="{{ auth()->user()->first_name }}"
              required>
      <label for="first_name">{{ __('app.profile.first_name') }}</label>
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
              autocomplete="last_name" placeholder="{{ __('app.profile.last_name') }}"
              value="{{ auth()->user()->last_name }}"
              required>
      <label for="last_name">{{ __('app.profile.last_name') }}</label>
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
          autocomplete="birthday" placeholder="{{ __('app.profile.birthday') }}"
          value="{{ optional(auth()->user()->userInfo)->birthday }}">
  <label for="birthday">{{ __('app.profile.birthday') }}</label>
  @error('birthday')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
  @enderror
</div>

<div class="form-floating mb-3">
  <input id="whatsapp" type="text" name="whatsapp"
          class="form-control @error('whatsapp') is-invalid @enderror"
          autocomplete="whatsapp" placeholder="{{ __('app.profile.whatsapp') }}"
          value="{{ optional(auth()->user()->userInfo)->whatsapp }}">
  <label for="whatsapp">{{ __('app.profile.whatsapp') }}</label>
  @error('whatsapp')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
  @enderror
</div>

<div class="form-floating mb-3">
  <input id="facebook" type="text" name="facebook"
          class="form-control @error('facebook') is-invalid @enderror"
          autocomplete="facebook" placeholder="{{ __('app.profile.facebook') }}"
          value="{{ optional(auth()->user()->userInfo)->facebook }}">
  <label for="facebook">{{ __('app.profile.facebook') }}</label>
  @error('facebook')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
  @enderror
</div>

<div class="form-floating mb-3">
  <input id="instagram" type="text" name="instagram"
          class="form-control @error('instagram') is-invalid @enderror"
          autocomplete="instagram" placeholder="{{ __('app.profile.instagram') }}"
          value="{{ optional(auth()->user()->userInfo)->instagram }}">
  <label for="instagram">{{ __('app.profile.instagram') }}</label>
  @error('instagram')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
  @enderror
</div>

<div class="form-floating mb-3">
  <input id="street_address" type="text" name="street_address"
          class="form-control @error('street_address') is-invalid @enderror"
          autocomplete="street_address" placeholder="{{ __('app.profile.street_address') }}"
          value="{{ optional(auth()->user()->userInfo)->street_address }}">
  <label for="street_address">{{ __('app.profile.street_address') }}</label>
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
              autocomplete="city" placeholder="{{ __('app.profile.city') }}"
              value="{{ optional(auth()->user()->userInfo)->city }}">
      <label for="city">{{ __('app.profile.city') }}</label>
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
              autocomplete="province" placeholder="{{ __('app.profile.province') }}"
              value="{{ optional(auth()->user()->userInfo)->province }}">
      <label for="province">{{ __('app.profile.province') }}</label>
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
              autocomplete="postal" placeholder="{{ __('app.profile.postal') }}"
              value="{{ optional(auth()->user()->userInfo)->postal }}">
      <label for="postal">{{ __('app.profile.postal') }}</label>
      @error('postal')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
  </div>
</div>
