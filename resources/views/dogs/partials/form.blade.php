<input type="hidden" name="user_id" value="{{ $user->id }}">
  
<fieldset id="fieldset-dog" class="d-block">
  <div class="row mb-3">
    <label for="dog_type" class="col-md-4 col-form-label">{{ __('Dog Type') }}</label>
    <div class="col-md-8">
      <input id="dog_type" value="{{ $dog->dog_type }}" type="text" class="form-control required @error('dog_type') is-invalid @enderror" name="dog_type" required autocomplete="dog_type">
      @error('dog_type')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
  </div>
  
  <div class="row mb-3">
    <label for="color" class="col-md-4 col-form-label">{{ __('Color') }}</label>
    <div class="col-md-8">
      <input id="color" value="{{ $dog->color }}" type="text" class="form-control required @error('color') is-invalid @enderror" name="color" required autocomplete="color">
      @error('color')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
  </div>

  <div class="row mb-3">
    <label for="temperament" class="col-md-4 col-form-label">{{ __('Temperament') }}</label>
    <div class="col-md-8">
      <input id="temperament" value="{{ $dog->temperament }}" type="text" class="form-control required @error('temperament') is-invalid @enderror" name="temperament" required autocomplete="temperament">
      @error('temperament')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
  </div>

  <div class="row mb-3">
    <label for="gender" class="col-md-4 col-form-label">{{ __('Gender') }}</label>
    <div class="col-md-8">
      <select class="form-select required select2 @error('area_id') is-invalid @enderror" name="gender">
        <option value=""></option>
        <option value="male" {{ $dog->gender === 'male' ? 'selected' : '' }}>{{ __('Male') }}</option>
        <option value="female" {{ $dog->gender === 'female' ? 'selected' : '' }}>{{ __('Female') }}</option>
      </select>
      @error('gender')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
  </div>

  <div class="row mb-3">
    <label for="size" class="col-md-4 col-form-label">{{ __('Size') }}</label>
    <div class="col-md-8">
      <select class="form-select required select2 @error('size') is-invalid @enderror" name="size">
        <option value=""></option>
        <option value="Small >10kg" {{ $dog->size === 'Small >10kg' ? 'selected' : '' }}>Small >10kg</option>
        <option value="Medium 11-15kg" {{ $dog->size === 'Medium 11-15kg' ? 'selected' : '' }}>Medium 11-15kg</option>
        <option value="Large 16-20kg" {{ $dog->size === 'Large 16-20kg' ? 'selected' : '' }}>Large 16-20kg</option>
        <option value="Extra Large 20+kg" {{ $dog->size === 'Extra Large 20+kg' ? 'selected' : '' }}>Extra Large 20+kg</option>
      </select>

      @error('size')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
  </div>

  <div class="row mb-3">
    <label for="description" class="col-md-4 col-form-label">{{ __('Description') }}</label>
    <div class="col-md-8">
      <textarea class="form-control required @error('description') is-invalid @enderror" id="description" name="description" required autocomplete="description">{{ $dog->description }}</textarea>
      @error('description')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
  </div>

  <div class="row mb-3">
    <label for="images" class="col-md-4 col-form-label">{{ __('Pictures') }}</label>
    <div class="col-md-8">

      <input id="images" type="file" class="form-control @error('images') is-invalid @enderror" name="images[]" autocomplete="images" multiple>
      @error('images')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>

    <div class="col-md-12 mt-3">
      <div class="image-preview p-3 w-100 border">
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
    {{ __('Submit') }}
  </button>
</fieldset>

<!-- AREA -->
<fieldset id="fieldset-area" class="d-none">
  <div class="row mb-3">
    <label for="area" class="col-md-4 col-form-label">{{ __('District') }}</label>
    <div class="col-md-8">
      <input class="form-control" type="text" name="area" value="{{ optional($dog->area)->name }}">
      @error('area')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
  </div>
  <div class="row mb-3">
    <label for="area" class="col-md-4 col-form-label">{{ __('Current Location') }}</label>
    <div class="col-md-8">
      <input class="form-control" type="text" name="map_link" value="{{ $dog->map_link }}">
      @error('area')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
  </div>
  <button type="submit" class="btn btn-custom-submit w-100">
    {{ __('Submit') }}
  </button>
</fieldset>