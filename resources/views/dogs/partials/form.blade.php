<input type="hidden" name="user_id" value="{{ $user->id }}">

<fieldset id="fieldset-dog" class="d-block">
  <div class="form-floating mb-3">
    <input id="dog_type" type="text" name="dog_type"
            class="form-control required @error('dog_type') is-invalid @enderror"
            autocomplete="dog_type" placeholder="{{ __('Dog Type') }}"
            value="{{ $dog->dog_type }}"
            required>
    <label for="dog_type">{{ __('Dog Type') }}</label>
    @error('dog_type')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>

  <div class="form-floating mb-3">
    <input id="color" type="text" name="color"
            class="form-control required @error('color') is-invalid @enderror"
            autocomplete="color" placeholder="{{ __('Color') }}"
            value="{{ $dog->color }}"
            required>
    <label for="color">{{ __('Color') }}</label>
    @error('color')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>

  <div class="form-floating mb-3">
    <input id="temprament" type="text" name="temperament"
            class="form-control required @error('temperament') is-invalid @enderror"
            autocomplete="temprament" placeholder="{{ __('Temperament') }}"
            value="{{ $dog->temperament }}"
            required>
    <label for="temprament">{{ __('Temperament') }}</label>
    @error('temprament')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>

  <div class="form-floating mb-3">
    <select id="gender" name="gender" class="form-select required @error('gender') is-invalid @enderror">
      <option value=""></option>
      <option value="male" {{ $dog->gender === 'male' ? 'selected' : '' }}>{{ __('Male') }}</option>
      <option value="female" {{ $dog->gender === 'female' ? 'selected' : '' }}>{{ __('Female') }}</option>
    </select>
    <label for="gender">{{ __('Gender') }}</label>
    @error('gender')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>

  <div class="form-floating mb-3">
    <select id="size" name="size" class="form-select required @error('size') is-invalid @enderror">
      <option value=""></option>
      <option value="Small >10kg" {{ $dog->size === 'Small >10kg' ? 'selected' : '' }}>Small >10kg</option>
      <option value="Medium 11-15kg" {{ $dog->size === 'Medium 11-15kg' ? 'selected' : '' }}>Medium 11-15kg</option>
      <option value="Large 16-20kg" {{ $dog->size === 'Large 16-20kg' ? 'selected' : '' }}>Large 16-20kg</option>
      <option value="Extra Large 20+kg" {{ $dog->size === 'Extra Large 20+kg' ? 'selected' : '' }}>Extra Large 20+kg</option>
    </select>
    <label for="size">{{ __('Size') }}</label>
    @error('size')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>

  <div class="form-floating mb-3">
    <textarea id="description" name="description" class="form-control required @error('description') is-invalid @enderror" style="height: 200px;">{{ $dog->description }}</textarea>
    <label for="description">{{ __('Description') }}</label>
    @error('description')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>

  <div class="form-floating mb-3">
    <input id="images" type="file" name="images[]"
            class="form-control @error('images') is-invalid @enderror"
            autocomplete="images" placeholder="{{ __('Pictures') }}"
            multiple>
    <label for="images">{{ __('Pictures') }}</label>
    @error('images')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>

  <div class="row mb-3">
    <div class="col-md-12 mt-3">
      <div class="image-preview p-3 w-100">
        @if ($action_name == "edit")
          <div id="old-images" class="position-relative mb-3">
            <button type="button" id="delete-old-image" class="btn-delete-images btn btn-danger">Delete</button>
            <p class="fw-bold">Old picture</p>
            <div class="row row-cols-3">
              @foreach ($images as $image)
                <div class="col mt-3">
                  <img src="{{$image->filename}}" class="preview-image" alt="Image Preview">
                </div>
              @endforeach
            </div>
          </div>
        @endif

        <div id="new-images" class="position-relative mb-3 d-none">
          <button type="button" id="delete-new-image" class="btn-delete-images btn btn-danger">Delete</button>
          <p class="fw-bold">New picture</p>
          <div class="images-wrapper row row-cols-3">
            {{-- WILL ADD NEW IMAGE HERE USING JS --}}
          </div>
        </div>
      </div>
    </div>
  </div>

  <button type="button" id="fake-submit" class="btn btn-custom-submit w-100">
    {{ __('Next') }}
  </button>
</fieldset>

<!-- AREA -->
<fieldset id="fieldset-area" class="d-none">
  <div class="form-floating mb-3">
    <select id="vaccinated" name="vaccinated" class="form-select required @error('vaccinated') is-invalid @enderror">
      <option value=""></option>
      <option value="true" {{ $dog->vaccinated === true ? 'selected' : '' }}>{{ __('Yes') }}</option>
      <option value="false" {{ $dog->vaccinated === false ? 'selected' : '' }}>{{ __('No') }}</option>
    </select>
    <label for="vaccinated">{{ __('vaccinated') }}</label>
    @error('vaccinated')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>

  <div class="form-floating mb-3">
    <select id="sterilization" name="sterilization" class="form-select required @error('sterilization') is-invalid @enderror">
      <option value=""></option>
      <option value="true" {{ $dog->sterilization === true ? 'selected' : '' }}>{{ __('Yes') }}</option>
      <option value="false" {{ $dog->sterilization === false ? 'selected' : '' }}>{{ __('No') }}</option>
    </select>
    <label for="sterilization">{{ __('sterilization') }}</label>
    @error('sterilization')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>
  <div class="form-floating mb-3">
    <input id="area" type="text" name="area" class="form-control" autocomplete="area" placeholder="{{ __('District') }}" value="{{ optional($dog->area)->name }}">
    <label for="area">{{ __('District') }}</label>
    @error('area')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>

  <div class="form-floating mb-5">
    <input id="map_link" type="text" name="map_link" class="form-control" autocomplete="map_link" placeholder="{{ __('Current Location') }}" value="{{ $dog->map_link }}">
    <label for="map_link">{{ __('Current Location') }}</label>
    @error('map_link')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>

  <button type="submit" class="btn btn-custom-submit w-100">
    {{ __('Submit') }}
  </button>
</fieldset>
