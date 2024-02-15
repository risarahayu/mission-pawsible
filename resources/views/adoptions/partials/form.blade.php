<input type="hidden" name="user_id" value="{{ $user->id }}">
<input type="hidden" name="dog_id" value="{{ $dog->id }}">
<input type="hidden" name="score" value="0">

@if($nationality_checked=='1'||'2')

  <!-- Housing Permission Radio Buttons -->
  <div class="form-card">
    <label class="form-label">{{ __('adoption.question.housing_permission') }}</label>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="housing_permission" id="housing_permission_yes" value="1">
      <label class="form-check-label" for="housing_permission_yes">
        {{ __('app.option.yes') }}
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="housing_permission" id="housing_permission_no" value="">
      <label class="form-check-label" for="housing_permission_no">
        {{ __('app.option.no') }}
      </label>
    </div>
  </div>

  <div id="next-question" style="display: none;">
    <!-- Housing Type Dropdown -->
    <div class="form-card">
      <div>
        <label for="housing_type" class="form-label"><span class="text-danger">*</span>{{ __('adoption.question.housing_type') }}</label>
        <select class="form-select calculate-score" id="housing_type" name="housing_type" required>
          <option value="compound" data-score="{{ $is_indonesian ? 30 : 25 }}">{{ __('adoption.option.compound') }}</option>
          <option value="private_villa" data-score="{{ $is_indonesian ? 25 : 20 }}">{{ __('adoption.option.private_villa') }}</option>
          <option value="guesthouse" data-score="{{ $is_indonesian ? 20 : 15 }}">{{ __('adoption.option.guesthouse') }}</option>
          <option value="kos" data-score="0">{{ __('adoption.option.kos') }}</option>
        </select>
      </div>
    </div>

    <!-- Housing Condition Radio Buttons -->
    <div class="form-card">
      <label class="form-label"><span class="text-danger">*</span>{{ __('adoption.question.housing_condition') }}</label>
      <div class="form-check">
        <input class="form-check-input calculate-score" type="radio" name="housing_condition" id="housing_condition_good" data-score="{{ $is_indonesian ? 30 : 25 }}" value="1">
        <label class="form-check-label" for="housing_condition_good">{{ __('app.option.yes') }}</label>
      </div>
      <div class="form-check">
        <input class="form-check-input calculate-score" type="radio" name="housing_condition" id="housing_condition_poor" data-score="0" value="0">
        <label class="form-check-label" for="housing_condition_poor">{{ __('app.option.no') }}</label>
      </div>
    </div>

    <!-- Housing picutre -->
    <div class="form-card">
      <div class="mb-3">
        <label for="images" class="form-label"><span class="text-danger">*</span>{{ __('adoption.question.housing_picture') }}</label>
        <input id="images" type="file" name="images[]"
                class="form-control required preview-input @error('images') is-invalid @enderror"
                autocomplete="images" placeholder="{{ __('adoption.placeholder.housing_picture') }}"
                multiple>
        <div class="form-text">{{ __('adoption.placeholder.housing_picture') }}</div>
        @error('images')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>

      <div class="image-preview border p-3 w-100 mb-3 d-none" data-preview-id="images">
        <div id="new-images" class="new-images position-relative mb-3 d-none">
          <button type="button" id="delete-new-image" class="btn-delete-images btn btn-danger delete-new-image">{{ __('app.button.delete') }}</button>
          <p class="fw-bold">{{ __('dog.form.preview') }}</p>
          <div class="images-wrapper row row-cols-3">
            {{-- WILL ADD NEW IMAGE HERE USING JS --}}
          </div>
        </div>
      </div>
    </div>

    <!-- Pet Experience -->
    <div class="form-card">
      <label><span class="text-danger">*</span>{{ __('adoption.question.pet_experience') }}</label><br>
      <div class="form-check">
        <input class="form-check-input calculate-score" type="radio" name="pet_experience" id="pet_experience_good" data-score="{{ $is_indonesian ? 10 : 5 }}" value="1">
        <label class="form-check-label" for="pet_experience_good">{{ __('app.option.yes') }}</label>
      </div>
      <div class="form-check">
        <input class="form-check-input calculate-score" type="radio" name="pet_experience" id="pet_experience_poor" data-score="0" value="0">
        <label class="form-check-label" for="pet_experience_poor">{{ __('app.option.no') }}</label>
      </div>
    </div>

    <!-- Vaccinated Radio Buttons -->
    <div class="form-card d-none" id="vaccinatedForm">
      <label class="form-label"><span class="text-danger">*</span>{{ __('adoption.question.vaccinated') }}</label>
      <div class="form-check">
        <input class="form-check-input calculate-score" type="radio" name="vaccinated" id="vaccinated_yes" data-score="{{ $is_indonesian ? 10 : 5 }}" value="1">
        <label class="form-check-label" for="vaccinated_yes">{{ __('app.option.yes') }}</label>
      </div>
      <div class="form-check">
        <input class="form-check-input calculate-score" type="radio" name="vaccinated" id="vaccinated_no" data-score="0" value="0">
        <label class="form-check-label" for="vaccinated_no">{{ __('app.option.no') }}</label>
      </div>
    </div>

    @if(!$is_indonesian)
      <!-- Residency Duration -->
      <div class="form-card">
        <label for="residency_duration" class="form-label"><span class="text-danger">*</span>{{ __('adoption.question.residency_duration') }}</label>
        <input type="text" placeholder="Example: 1 year" class="form-control" id="residency_duration" name="residency_duration" required>
      </div>

      <!-- Planned Residency Duration -->
      <div class="form-card">
        <label for="planned_residency_duration" class="form-label"><span class="text-danger">*</span>{{ __('adoption.question.planned_residency_duration') }}</label>
        <input type="text" placeholder="Example: 1 year" class="form-control" id="planned_residency_duration" name="planned_residency_duration" required>
      </div>

      <!-- Future Residency Country -->
      <div class="form-card">
        <label for="future_residency_country" class="form-label"><span class="text-danger">*</span>{{ __('adoption.question.future_residency_country') }}</label>
        <input type="text" class="form-control" id="future_residency_country" name="future_residency_country" required>
      </div>

      <!-- Pet Migration Plan Radio Buttons -->
      <div class="form-card">
        <label class="form-label"><span class="text-danger">*</span>{{ __('adoption.question.pet_migration_plan') }}</label>
        <div class="form-check">
          <input class="form-check-input calculate-score" type="radio" name="pet_migration_plan" id="pet_migration_plan_yes" data-score="20" value="1">
          <label class="form-check-label" for="pet_migration_plan_yes">{{ __('app.option.yes') }}</label>
        </div>
        <div class="form-check">
          <input class="form-check-input calculate-score" type="radio" name="pet_migration_plan" id="pet_migration_plan_no" data-score="0" value="0">
          <label class="form-check-label" for="pet_migration_plan_no">{{ __('app.option.no') }}</label>
        </div>
      </div>
    @endif

    <!-- Job Dropdown -->
    <div class="form-card">
      <label for="job" class="form-label"><span class="text-danger">*</span>{{ __('adoption.question.job') }}</label>
      <select class="form-select calculate-score" id="job" name="job" required>
        <option value="wfo" data-score="0">{{ __('adoption.option.wfo') }}</option>
        <option value="wfh" data-score="20">{{ __('adoption.option.wfh') }}</option>
        <option value="na" data-score="0">{{ __('adoption.option.na') }}</option>
      </select>
    </div>

    <!-- Who is Home -->
    <div class="form-card" id="house_occupants">
      <label for="house_occupants" class="form-label"><span class="text-danger">*</span>{{ __('adoption.question.house_occupants') }}</label>
      <div class="form-check">
        <input class="form-check-input calculate-score" type="radio" name="house_occupants" id="house_occupants_good" data-score="15" value="1">
        <label class="form-check-label" for="house_occupants_good">{{ __('app.option.yes') }}</label>
      </div>
      <div class="form-check">
        <input class="form-check-input calculate-score" type="radio" name="house_occupants" id="house_occupants_poor" data-score="0" value="0">
        <label class="form-check-label" for="house_occupants_poor">{{ __('app.option.no') }}</label>
      </div>
    </div>

    <!-- Canine Residence -->
    <div class="form-card d-none" id="canine_residence">
      <label for="canine_residence" class="form-label"><span class="text-danger">*</span>{{ __('adoption.question.canine_residence') }}</label>
      <input type="text" class="form-control" name="canine_residence" >
    </div>

    <div class="form-card">
      <p>
        <strong>{{ __('adoption.term_and_condition.title') }}</strong>
      </p>

      <p>
        {{ __('adoption.term_and_condition.sub_title') }}
      </p>

      <ol>
        <li>{{ __('adoption.term_and_condition.line_1') }}</li>
        <li>{{ __('adoption.term_and_condition.line_2') }}</li>
        <li>{{ __('adoption.term_and_condition.line_3') }}</li>
        <li>{{ __('adoption.term_and_condition.line_4') }}</li>
        <li>{{ __('adoption.term_and_condition.line_5') }}</li>
        <li>{{ __('adoption.term_and_condition.line_6') }}</li>
        <li>{{ __('adoption.term_and_condition.line_7') }}</li>
      </ol>

      <p>
        {{ __('adoption.term_and_condition.end_line') }}
      </p>
      <div class="form-check mt-3">
        <input class="form-check-input" type="checkbox" value="" id="agreementCheckbox" required>
        <label class="form-check-label" for="agreementCheckbox">
          {{ __('adoption.term_and_condition.checkbox') }}
        </label>
      </div>
    </div>
  </div>
<div>

@endif
