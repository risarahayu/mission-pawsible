<input type="hidden" name="user_id" value="{{ $user->id }}">
@if ($action_name == 'edit')
  <input type="hidden" id="delete_image" name="delete_image" value="0">
  <input type="hidden" id="delete_vaccication" name="delete_vaccication" value="0">
  <input type="hidden" id="delete_sterilization" name="delete_sterilization" value="0">
@endif

{{-- First fieldset for dog information --}}
<fieldset id="fieldset-dog" class="d-block">
  {{-- Dog type / category --}}
  <div class="mb-3">
    <label for="dog_type" class="form-label"><span class="text-danger">*</span>{{ __('dog.form.dog_type') }}</label>
    <input id="dog_type" type="text" name="dog_type"
            class="form-control required @error('dog_type') is-invalid @enderror"
            autocomplete="dog_type" placeholder="{{ __('dog.form.placeholder.dog_type') }}"
            value="{{ $action_name === "create" ? old('dog_type') : $dog->dog_type }}"
            required>
    @error('dog_type')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>

  {{-- Dog color --}}
  <div class="mb-3">
    <label for="color" class="form-label"><span class="text-danger">*</span>{{ __('dog.form.color') }}</label>
    <input id="color" type="text" name="color"
            class="form-control required @error('color') is-invalid @enderror"
            autocomplete="color" placeholder="{{ __('dog.form.placeholder.color') }}"
            value="{{ $action_name === "create" ? old('color') :  $dog->color }}"
            required>
    @error('color')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>

  {{-- Dog temperament --}}
  <div class="mb-3">
    <label for="temprament"class="form-label"><span class="text-danger">*</span>{{ __('dog.form.temperament') }}</label>
    <input id="temprament" type="text" name="temperament"
            class="form-control required @error('temperament') is-invalid @enderror"
            autocomplete="temprament" placeholder="{{ __('dog.form.placeholder.temperament') }}"
            value="{{ $action_name === "create" ? old('temperament') :  $dog->temperament }}"
            required>
    @error('temprament')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>

  {{-- Dog gender, remember only 2 gender --}}
  <label for="gender" class="form-label"><span class="text-danger">*</span>{{ __('dog.form.gender') }}</label>
  <div class="mb-3">
    <select id="gender" name="gender" class="form-select required @error('gender') is-invalid @enderror">
      <option value="">{{ __('dog.form.placeholder.gender') }}</option>
      <option value="male" {{ ($action_name === "create" ? old('gender') :  $dog->gender) === 'male' ? 'selected' : '' }}>{{ __('dog.form.option.male') }}</option>
      <option value="female" {{ ($action_name === "create" ? old('gender') :  $dog->gender) === 'female' ? 'selected' : '' }}>{{ __('dog.form.option.female') }}</option>
    </select>
    @error('gender')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>

  {{-- Dog size --}}
  <label for="size" class="form-label"><span class="text-danger">*</span>{{ __('dog.form.size') }}</label>
  <div class="mb-3">
    <select id="size" name="size" class="form-select required @error('size') is-invalid @enderror">
      <option value="">{{ __('dog.form.placeholder.size') }}</option>
      <option value="small" {{ ($action_name === "create" ? old('size') : $dog->size) === 'small' ? 'selected' : '' }}>{{ __('dog.form.option.small') }}</option>
      <option value="medium" {{ ($action_name === "create" ? old('size') : $dog->size) === 'medium' ? 'selected' : '' }}>{{ __('dog.form.option.medium') }}</option>
      <option value="large" {{ ($action_name === "create" ? old('size') : $dog->size) === 'large' ? 'selected' : '' }}>{{ __('dog.form.option.large') }}</option>
      <option value="extra" {{ ($action_name === "create" ? old('size') : $dog->size) === 'extra' ? 'selected' : '' }}>{{ __('dog.form.option.extra') }}</option>
    </select>
    @error('size')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>

  {{-- Dog description / detail --}}
  <div class="mb-3">
    <label for="description" class="form-label"><span class="text-danger">*</span>{{ __('dog.form.description') }}</label>
    <textarea id="description" placeholder="{{ __('dog.form.placeholder.description') }}" name="description" class="form-control required @error('description') is-invalid @enderror" style="height: 200px;">{{ $action_name === "create" ? old('description') : $dog->description }}</textarea>
    @error('description')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>

  {{-- -----------DOG PICTURE----------- --}}
    {{-- Dog picture, input only --}}
    <div class="mb-3">
      <label for="images" class="form-label"><span class="text-danger">*</span>{{ __('dog.form.dog_picture') }}</label>
      <input id="images" type="file" name="images[]"
              class="form-control required preview-input @error('images') is-invalid @enderror"
              autocomplete="images" placeholder="{{ __('dog.form.placeholder.dog_picture') }}"
              multiple>
      <div class="form-text">{{ __('dog.form.placeholder.dog_picture') }}</div>
      @error('images')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>

    {{-- Picture preview --}}
    <div class="image-preview border p-3 w-100 mb-3 @if($action_name == "create") d-none @endif" data-preview-id="images">
      @if ($action_name == "edit")
        {{-- For edit page, showing uploaded picture --}}
        <div id="old-images" class="position-relative mb-3 old-images">
          <button type="button" id="delete-old-image" class="btn-delete-images btn btn-danger delete-old-image" data-delete-id="delete_image">{{ __('app.button.delete') }}</button>
          <p class="fw-bold">{{ __('dog.form.old_picture') }}</p>
          <div class="row row-cols-3">
            @php $dog_images = $controller_name == 'dog' ? $images->where('category', null) : $images @endphp
            @foreach ($dog_images as $image)
              <div class="col mt-3">
                <img src="{{$image->filename}}" class="preview-image" alt="Image Preview">
              </div>
            @endforeach
          </div>
        </div>
      @endif

      {{-- New pciture preview for dog --}}
      <div id="new-images" class="new-images position-relative mb-3 d-none">
        <button type="button" id="delete-new-image" class="btn-delete-images btn btn-danger delete-new-image">{{ __('app.button.delete') }}</button>
        <p class="fw-bold">{{ $action_name === 'create' ? __('dog.form.preview') : __('dog.form.new_picture') }}</p>
        <div class="images-wrapper row row-cols-3">
          {{-- WILL ADD NEW IMAGE HERE USING JS --}}
        </div>
      </div>
    </div>
  {{-- -----------END----------- --}}

  <!-- {{-- Custom fake submit, Js file -> views/dogs/partials/js.blade.php --}}
  <button type="button" id="fake-submit" class="btn btn-custom-submit w-100">
    {{ __('app.button.next') }}
  </button>
</fieldset> -->

{{----------------NEXT PAGE----------------}}

{{-- Second fieldset is for Area and dog certificate --}}
<!-- <fieldset id="fieldset-area" class="d-none"> -->
  @if ($controller_name == 'dog')

    {{-- Dog last vaccinated date --}}
    <div class="mb-3">
      <label for="vaccinated_date" class="form-label"><span class="text-danger">*</span>{{ __('dog.form.vaccinated_date') }}</label>
      <input id="vaccinated_date" type="date" name="vaccinated_date"
              class="form-control required @error('vaccinated_date') is-invalid @enderror"
              autocomplete="vaccinated_date" placeholder="{{ __('vaccinated_date') }}"
              value="{{ $action_name === "create" ? old('vaccinated_date') : $dog->vaccinated_date }}" required>
      @error('vaccinated_date')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>

    {{-- -----------VACCINATION CERTIFICATE----------- --}}
      {{-- Dog vaccination certificate --}}
      <div class="mb-3">
        <label for="vaccination_certificate" class="form-label"><span class="text-danger">*</span>{{ __('dog.form.vaccination_certificate') }}</label>
        <input id="vaccination_certificate" type="file" name="vaccination_certificate[]"
                class="form-control required preview-input @error('vaccination_certificate') is-invalid @enderror"
                autocomplete="vaccination_certificate" placeholder="{!! __('dog.form.placeholder.vaccinated_certificate') !!}"
                multiple>
        <div class="form-text">{!! __('dog.form.placeholder.vaccination_certificate') !!}</div>
        @error('vaccination_certificate')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>

      {{-- Vaccination certificate preview --}}
      <div class="image-preview border p-3 w-100 mb-3 @if($action_name == "create") d-none @endif" data-preview-id="vaccination_certificate">
        @if ($action_name == "edit")
          <div id="old-images" class="position-relative mb-3 old-images">
            <button type="button" id="delete-old-image" class="btn-delete-images btn btn-danger" data-delete-id="delete_vaccination">{{ __('app.button.delete') }}</button>
            <p class="fw-bold">{{ __('dog.form.old_picture') }}</p>
            <div class="row row-cols-3">
              @foreach ($images->where('category', 'vaccination') as $image)
                <div class="col mt-3">
                  <img src="{{$image->filename}}" class="preview-image" alt="Image Preview">
                </div>
              @endforeach
            </div>
          </div>
        @endif

        <div id="new-images" class="new-images position-relative mb-3 d-none">
          <button type="button" id="delete-new-image" class="btn-delete-images btn btn-danger delete-new-image">{{ __('app.button.delete') }}</button>
          <p class="fw-bold">{{ $action_name === 'create' ? __('dog.form.preview') : __('dog.form.new_picture') }}</p>
          <div class="images-wrapper row row-cols-3">
            {{-- WILL ADD NEW IMAGE HERE USING JS --}}
          </div>
        </div>
      </div>
    {{-- -----------END----------- --}}

    {{-- Sterilization date --}}
    <!-- <div class="mb-3">
      <label for="sterilization_date" class="form-label">{{ __('Sterilization Date') }}</label>
      <input id="sterilization_date " type="date" name="sterilization_date"
              class="form-control @error('sterilization_date') is-invalid @enderror"
              autocomplete="sterilization_date" placeholder="{{ __('Sterilization Date') }}"
              value="{{ $action_name === "create" ? old('sterilization_date') : $dog->sterilization_date }}" >
      @error('sterilization_date')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
    </div> -->

    {{-- -----------STERILIZATION CERTIFICATE----------- --}}

      {{-- Dog sterilization certificate --}}
      <div class="mb-3">
        <label for="sterilization_certificate" class="form-label"><span class="text-danger">*</span>{{ __('dog.form.sterilization_certificate') }}</label>
        <input id="sterilization_certificate" type="file" name="sterilization_certificate[]"
              class="form-control preview-input"
              autocomplete="sterilization_certificate" placeholder="{{ __('Evidence that shows the dog has been sterilized (optional)') }}"
              multiple> 
        <div class="form-text">{!! __('dog.form.placeholder.sterilization_certificate') !!}</div>
        @error('sterilization_certificate')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>

      {{-- sterilization certificate preview --}}
      <div class="image-preview border p-3 w-100 mb-3 @if($action_name == 'create' || $images->where('category', 'sterilization')->count() == 0) d-none @endif" data-preview-id="sterilization_certificate">
        @if ($action_name == "edit" && $images->where('category', 'sterilization')->count() > 0)
          <div id="old-images" class="position-relative mb-3 old-images">
            <button type="button" id="delete-old-image" class="btn-delete-images btn btn-danger" data-delete-id="delete_sterilization">{{ __('app.button.delete') }}</button>
            <p class="fw-bold">{{ __('dog.form.old_picture') }}</p>
            <div class="row row-cols-3">
              @foreach ($images->where('category', 'sterilization') as $image)
                <div class="col mt-3">
                  <img src="{{$image->filename}}" class="preview-image" alt="Image Preview">
                </div>
              @endforeach
            </div>
          </div>
        @endif

        <div id="new-images" class="new-images position-relative mb-3 d-none">
          <button type="button" id="delete-new-image" class="btn-delete-images btn btn-danger delete-new-image">{{ __('app.button.delete') }}</button>
          <p class="fw-bold">{{ $action_name === 'create' ? __('dog.form.preview') : __('dog.form.new_picture') }}</p>
          <div class="images-wrapper row row-cols-3">
            {{-- WILL ADD NEW IMAGE HERE USING JS --}}
          </div>
        </div>
      </div>
    {{-- -----------END----------- --}}
  @endif

  {{-- Dog area --}}
  <div class="mb-3">
    <label for="area" class="form-label"><span class="text-danger">*</span>{{ __('District') }}</label>
    <select id="area" name="area" class="form-select required @error('area') is-invalid @enderror">
      <option value="">{{ __('dog.form.placeholder.area') }}</option>
      @foreach (['badung', 'bangli', 'buleleng', 'gianyar', 'jembrana', 'karangasem', 'klungkung', 'tabanan', 'denpasar'] as $area)
        <option value="{{ $area }}" {{ ($action_name === "create" ? old('area') : optional($dog->area)->name) === $area ? 'selected' : '' }}>{{ ucfirst($area) }}</option>
      @endforeach
    </select>
    @error('area')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>

  {{-- Dog area map link --}}
  <div class="mb-5">
    <label class="form-label" for="map_link"><span class="text-danger">*</span>{{ __('dog.form.map_link') }}</label>
    <input id="map_link" type="text" name="map_link" class="form-control required" autocomplete="map_link" placeholder="{{ __('dog.form.placeholder.map_link') }}" value="{{ $action_name === "create" ? old('map_link') : $dog->map_link }}" required>
    @error('map_link')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>

  {{-- This is real submit --}}
  <button type="submit" class="btn btn-custom-submit w-100">
    {{ __('dog.form.button.submit') }}
  </button>
</fieldset>
