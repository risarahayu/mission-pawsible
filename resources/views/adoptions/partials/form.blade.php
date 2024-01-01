<input type="hidden" name="user_id" value="{{ $user->id }}">
<input type="hidden" name="dog_id" value="{{ $dog->id }}">

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
        <option value="Private Villa">Private Villa</option>
        <option value="Guesthouse">Guesthouse</option>
        <option value="Kos">Kos</option>
        <option value="Compound">Compound</option>
      </select>
    </div>
  </div>

  <!-- Housing Condition Radio Buttons -->
  <div class="form-card">
    <label class="form-label">Is your yard fully enclosed without the use of cages, chains, or unrestricted animal roaming?</label>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="housing_condition" id="housing_condition_good" value="1">
      <label class="form-check-label" for="housing_condition_good">Yes</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="housing_condition" id="housing_condition_poor" value="0">
      <label class="form-check-label" for="housing_condition_poor">No</label>
    </div>
  </div>

  <!-- Pet Experience -->
  <div class="form-card">
    <label for="pet_experience" class="form-label">Have you had a dog before? If so, please give us details</label>
    <textarea class="form-control" id="pet_experience" name="pet_experience" style="height: 200px;" required></textarea>
  </div>

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
    <label for="future_residency_country" class="form-label">If departing from Bali, which country would be your subsequent destination?</label>
    <input type="text" class="form-control" id="future_residency_country" name="future_residency_country" required>
  </div>

  <!-- Pet Migration Plan Radio Buttons -->
  <div class="form-card">
    <label class="form-label">In the event of departing from Bali, do you plan to relocate with your pets?</label>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="pet_migration_plan" id="pet_migration_plan_yes" value="1">
      <label class="form-check-label" for="pet_migration_plan_yes">Yes</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="pet_migration_plan" id="pet_migration_plan_no" value="0">
      <label class="form-check-label" for="pet_migration_plan_no">No</label>
    </div>
  </div>

  <!-- Job Dropdown -->
  <div class="form-card">
    <label for="job" class="form-label">Do you have a job? If so, which one is your occupation:</label>
    <select class="form-select" id="job" name="job" required>
      <option value="Full Time">Full Time</option>
      <option value="Part Time">Part Time</option>
      <option value="Casual">Casual</option>
      <option value="Work From Home">Work From Home</option>
      <option value="Not Applicable">Not Applicable</option>
    </select>
  </div>

  <!-- Who is Home -->
  <div class="form-card" id="house_occupants">
    <label for="house_occupants" class="form-label">If you work full-time, is there someone present at home to look after the dogs throughout the day?</label>
    <input type="text" class="form-control" name="house_occupants" required>
  </div>

  <!-- Canine Residence -->
  <div class="form-card" id="canine_residence">
    <label for="canine_residence" class="form-label">If "No" where are they kept?</label>
    <input type="text" class="form-control" name="canine_residence" required>
  </div>

  <!-- Vaccinated Radio Buttons -->
  <div class="form-card">
    <label class="form-label">Are your pets fully vaccinated?</label>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="vaccinated" id="vaccinated_yes" value="1">
      <label class="form-check-label" for="vaccinated_yes">Yes</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="vaccinated" id="vaccinated_no" value="0">
      <label class="form-check-label" for="vaccinated_no">No</label>
    </div>
  </div>
</div>
