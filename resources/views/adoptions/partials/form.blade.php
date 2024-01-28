<input type="hidden" name="user_id" value="{{ $user->id }}">
<input type="hidden" name="dog_id" value="{{ $dog->id }}">
<input type="hidden" name="score">

@if($nationality_checked=='1'||'2')
  
  <!-- Housing Permission Radio Buttons -->
  <div class="form-card">
    <label class="form-label">Do you have 100% approval from your family / partner / housemate / landlord? </label>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="housing_permission" id="housing_permission_yes" value="1">
      <label class="form-check-label" for="housing_permission_yes">
        Yes
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="housing_permission" id="housing_permission_no" value="">
      <label class="form-check-label" for="housing_permission_no">
        No
      </label>
    </div>
  </div>

  <div id="next-question" style="display: none;">
    <!-- Housing Type Dropdown -->
    <div class="form-card">
      <div>
        <label for="housing_type" class="form-label">Housing Type</label>
        <select class="form-select" id="housing_type" name="housing_type" required>
          <option value="Compound" data-score="{{ $is_indonesian=='1' ? 30 : 25 }}">Compound / Private House</option>
          <option value="Private Villa" data-score="{{ $is_indonesian=='1' ? 25 : 20 }}">Private Villa</option>
          <option value="Guesthouse" data-score="{{ $is_indonesian=='1' ? 20 : 15 }}">Guesthouse</option>
          <option value="Kos" data-score="0">Kos</option>
        </select>
      </div>
    </div>

    <!-- Housing Condition Radio Buttons -->
    <div class="form-card">
      <label class="form-label">Is your yard fully enclosed without the use of cages, chains, or unrestricted animal roaming?</label>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="housing_condition" id="housing_condition_good" value="1">
        <label class="form-check-label" for="housing_condition_good" data-score="{{ $is_indonesian=='1' ? 30 : 25 }}">Yes</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="housing_condition" id="housing_condition_poor" value="0">
        <label class="form-check-label" for="housing_condition_poor" data-score="0">No</label>
      </div>
    </div>

    <!-- Housing picutre -->
    <div class="form-card">
      <div class="mb-3">
        <label for="images" class="form-label"><span class="text-danger">*</span>{{ __('dog.form.dog_picture') }}</label>
        <input id="images" type="file" name="images[]"
                class="form-control required preview-input @error('images') is-invalid @enderror"
                autocomplete="images" placeholder="{{ __('dog.form.placeholder.dog_picture') }}"
                multiple>
        <div class="form-text">{{ __('dog.form.placeholder.house_picture') }}</div>
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
      <label>Have you had a dog before?</label><br>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="dog_experience" id="dog_experience_good" value="1" onclick="toggleForm()">
        <label class="form-check-label" for="dog_experience_good" data-score="{{ $is_indonesian=='1' ? 10 : 5 }}">Yes</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="dog_experience" id="dog_experience_poor" value="0" onclick="toggleForm()">
        <label class="form-check-label" for="dog_experience_poor" data-score="0">No</label>
      </div>

      <!-- Tambahkan style="display: none;" pada textarea -->
      <textarea id="petExperience" class="form-control" name="pet_experience" style="height: 200px; display: none;"  placeholder="Please give us details"></textarea>
    </div>

    <!-- Vaccinated Radio Buttons -->
    <div class="form-card" id="vaccinatedForm" style="display:none;">
      <label class="form-label">Are your pets fully vaccinated?</label>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="vaccinated" id="vaccinated_yes" data-score="{{ $is_indonesian=='1' ? 10 : 5 }}" value="1">
        <label class="form-check-label" for="vaccinated_yes">Yes</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="vaccinated" id="vaccinated_no" data-score="0" value="0">
        <label class="form-check-label" for="vaccinated_no">No</label>
      </div>
    </div>

    <script>
      function toggleForm() {
          var dogExperience = document.querySelector('input[name="dog_experience"]:checked').value;
          var petExperienceForm = document.getElementById('petExperience');
          var vaccinatedForm = document.getElementById('vaccinatedForm');

          // Sembunyikan semua formulir tambahan
          petExperienceForm.style.display = 'none';
          vaccinatedForm.style.display = 'none';

          // Tampilkan formulir tambahan yang sesuai berdasarkan jawaban
          if (dogExperience === 'yes') {
              petExperienceForm.style.display = 'block';
              vaccinatedForm.style.display = 'block';
          }
      }
    </script>

    @if($is_indonesian=="2")
      <!-- Residency Duration -->
      <div class="form-card">
        <label for="residency_duration" class="form-label">How Long have you lived in Bali?</label>
        <input type="text" class="form-control" id="residency_duration" name="residency_duration" required>
      </div>

      <!-- Planned Residency Duration -->
      <div class="form-card">
        <label for="planned_residency_duration" class="form-label">How long do you plan to be in Bali?</label>
        <input type="text" class="form-control" id="planned_residency_duration" name="planned_residency_duration" required>
      </div>

      <!-- Future Residency Country -->
      <div class="form-card">
        <label for="future_residency_country" class="form-label">When departing from Bali, which country would be your subsequent destination?</label>
        <input type="text" class="form-control" id="future_residency_country" name="future_residency_country" required>
      </div>

      <!-- Pet Migration Plan Radio Buttons -->
      <div class="form-card">
        <label class="form-label">In the event of departing from Bali, do you plan to relocate with your pets?</label>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pet_migration_plan" id="pet_migration_plan_yes" data-score="20" value="1">
          <label class="form-check-label" for="pet_migration_plan_yes">Yes</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pet_migration_plan" id="pet_migration_plan_no" data-score="20" value="0">
          <label class="form-check-label" for="pet_migration_plan_no">No</label>
        </div>
      </div>
    @endif

    <!-- Job Dropdown -->
    <div class="form-card">
      <label for="job" class="form-label">Do you have a job? If so, which one is your occupation:</label>
      <select class="form-select" id="job" name="job" required>
        <option value="Full Time" data-score="0">Full Time</option>
        <option value="Part Time" data-score="15">Part Time</option>
        <option value="Casual" data-score="15">Casual</option>
        <option value="Work From Home" data-score="20">Work From Home</option>
        <option value="Not Applicable" data-score="0">Not Applicable</option>
      </select>
    </div>

    <!-- Who is Home -->
    <div class="form-card" id="house_occupants">
      <label for="house_occupants" class="form-label">If you work full-time, is there someone present at home to look after the dogs throughout the day?</label>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="house_occupants" id="house_occupants_good" value="1">
        <label class="form-check-label" for="house_occupants_good" data-score="20">Yes</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="house_occupants" id="house_occupants_poor" value="0">
        <label class="form-check-label" for="house_occupants_poor" data-score="0">No</label>
      </div>
    </div>

    <!-- Canine Residence -->
    <div class="form-card d-none" id="canine_residence">
      <label for="canine_residence" class="form-label">If "No" where are they kept?</label>
      <input type="text" class="form-control" name="canine_residence" >
    </div>

    <div class="form-card">
      <p>
        <strong>Syarat dan Ketentuan Adopsi Hewan Peliharaan:</strong>
      </p>

      <p>
          Dengan mengajukan permohonan adopsi, pemohon setuju dan memahami bahwa:
      </p>

      <ol>
          <li>Pemilik baru harus memberikan perawatan yang baik dan penuh cinta kepada hewan peliharaan yang diadopsi.</li>
          <li>Pemilik baru bertanggung jawab atas semua biaya perawatan hewan, termasuk vaksinasi yang diperlukan.</li>
          <li>Pemilik baru wajib memastikan keadaan kesehatan dan kebahagiaan hewan peliharaan yang diadopsi.</li>
          <li>Pengelola berhak melakukan pemantauan setelah adopsi untuk memastikan bahwa hewan peliharaan mendapatkan perawatan yang optimal.</li>
          <li>Pengelola berhak untuk memutuskan adopsi jika terdapat penelantaran atau perlakuan tidak baik terhadap hewan peliharaan.</li>
          <li>Pemohon dianggap telah membaca, memahami, dan menerima syarat dan ketentuan ini sebelum mengajukan permohonan adopsi.</li>
          <li>Adopsi anjing bukan untuk diperjualbelikan</li>
      </ol>

      <p>
        Dengan menandatangani atau mengajukan permohonan adopsi, pemohon menyatakan kesediaannya untuk mematuhi dan menghormati syarat dan ketentuan ini selama dan setelah proses adopsi.
      </p>
      <div class="form-check mt-3">
        <input class="form-check-input" type="checkbox" value="" id="agreementCheckbox" required>
        <label class="form-check-label" for="agreementCheckbox">
            Saya menyetujui semua syarat dan ketentuan di atas.
        </label>
      </div>
    </div>
  </div>
<div>

@endif
