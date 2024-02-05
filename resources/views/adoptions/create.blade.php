@extends('layouts.app')

@section('content')
  <section>
    <div class="container adoptions">
      <img class="step-image" src="{{asset('images/step/step 1.svg')}}" alt="">
      <div class="text-center m-auto my-2 text-base-color">
        <p class="fs-4 m-0">{{ __('app.step.first') }}</p>
        <p class="alert alert-info m-auto mb-3">{{ __('adoption.alert.complete_adoption') }}</p>
      </div>
      @if(is_null($is_indonesian))
        <form action="{{ route('adoptions.create', ['dog' => $dog]) }}" method="get">
          @csrf
          <div class="form-card">
            <h1 class="fw-bold text-center mb-2">{{ __('adoption.title') }}</h1>
          </div>
          <div class="form-card">
            <label class="form-label">{{ __('adoption.question.indonesian') }}</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="is_indonesian" id="yes" value="1">
              <label class="form-check-label" for="yes">{{ __('app.option.yes') }}</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="is_indonesian" id="no" value="0">
              <label class="form-check-label" for="no">{{ __('app.option.no') }}</label>
            </div>
          </div>

          <button type="submit" class="btn btn-primary">{{ __('app.button.continue') }}</button>
        </form>
      @else
        <form id="adoption_form" method="POST" action="{{ route('adoptions.store') }}" enctype="multipart/form-data">
          @csrf
          <div class="form-card">
            <h1 class="fw-bold text-center mb-2">{{ __('Adoptions') }}</h1>
          </div>
          @include('adoptions.partials.form')
          <div class="mt-3">
            <button type="submit" class="btn btn-custom-submit w-100 d-none" id="submitButton" disabled>Submit</button>
          </div>
        </form>
      @endif
    </div>
  </section>
@endsection

@section('scripts')
  <!-- JavaScript Section -->
  <script type="module">
    $(function () {
      // Mendengarkan perubahan pada radio button "housing_permission"
      $('input[name="housing_permission"]').on('change', function () {
        // Cek apakah pengguna memiliki persetujuan
        if (!!this.value) {
          // Jika memiliki persetujuan, tampilkan pertanyaan berikutnya
          $('#next-question').show();
          $('#cannot-proceed').hide();
          $("button[type=submit]").removeClass("d-none");
        } else {
          // Jika tidak memiliki persetujuan, tampilkan pesan "Tidak bisa lanjut"
          $('#next-question').hide();
          $('#cannot-proceed').show();
          $("button[type=submit]").addClass("d-none");

          // resetForm();
        }
      });

      $('input[name="house_occupants"]').on('change', function () {
        if ($(this).val() == "1") {
          $("#canine_residence").addClass("d-none");
        } else {
          $("#canine_residence").removeClass("d-none");
        }
      });

      // job
      // Mendengarkan perubahan pada dropdown "job"
      $('#job').on('change', function () {
        var jobValue = $(this).val();

        // Menampilkan atau menyembunyikan elemen berdasarkan pilihan pekerjaan
        if (jobValue == 'Full Time') {
          $('#house_occupants').show();
          $('#canine_residence').show();
        } else {
          $('#house_occupants').hide();
          $('#canine_residence').hide();
        }
      });

      // Fungsi ini akan dipanggil ketika tombol "Delete New Image" diklik
      $('.delete-new-image').on('click', function () {
        var parents = $(this).parents('.image-preview');
        var targetId = parents.data('previewId');

        // Kosongkan nilai dari input file #images
        $(`#${targetId}`).val('');

        // Sembunyikan #new-images parent dari #delete-new-image
        $(this).parent().addClass('d-none');

        if (parents.find('.old-images').length == 0) {
          parents.addClass("d-none");
          $(`#${targetId}`).addClass("required");
        } else {
          parents.removeClass("d-none");
        }
      });

      $('.preview-input').on('change', function (e) {
        var imagePreview = $(`[data-preview-id="${$(this).prop('id')}"]`);

        // Kosongkan #new-images
        imagePreview.find('.images-wrapper').empty();

        // Loop melalui file yang dipilih
        $.each(this.files, function (index, file) {
          // Buat elemen gambar baru
          var img = $('<img/>', {
            class: 'preview-image',
            alt: 'Image Preview',
          });

          // Buat objek URL untuk file yang dipilih
          var imgURL = URL.createObjectURL(file);

          // Atur sumber gambar ke URL objek yang dibuat
          img.attr('src', imgURL);

          // Tambahkan gambar ke #new-images
          imagePreview.find('.images-wrapper').append(img);
        });

        // Tampilkan #new-images jika ada gambar yang dipilih
        if (this.files.length > 0) {
          imagePreview.find('.new-images').removeClass('d-none');
          $(this).removeClass("required");
          imagePreview.removeClass("d-none");
          imagePreview.addClass("border");
        } else {
          $(this).addClass("required");
          $('#new-images').addClass('d-none');
          imagePreview.addClass("d-none");
        }
      });

      var housing_type = {{ $is_indonesian ? 30 : 25 }};
      var housing_condition = 0;
      var dog_experience = 0;
      var vaccinated = 0;
      var pet_migration_plan = 0;
      var job = 0;
      var house_occupants = 0;

      $(".calculate-score").change(function () {
        if ($(this).prop('name') == "housing_type") {
          housing_type = $(this).find('option:selected').data('score');
        } else if ($(this).prop('name') == "housing_condition") {
          housing_condition = $(this).data('score');
        } else if ($(this).prop('name') == "dog_experience") {
          if ($(this).val() == '1') {
            $('#vaccinatedForm').toggleClass('d-none d-block');
          } else {
            $('#vaccinatedForm').toggleClass('d-block d-none');
          }
          dog_experience = $(this).data('score');
        } else if ($(this).prop('name') == "vaccinated") {
          vaccinated = $(this).data('score');
        } else if ($(this).prop('name') == "pet_migration_plan") {
          pet_migration_plan = $(this).data('score');
        } else if ($(this).prop('name') == "job") {
          job = $(this).find('option:selected').data('score');
        } else if ($(this).prop('name') == "house_occupants") {
          house_occupants = $(this).data('score');
        }
      });

      $("form#adoption_form").submit(function(event) {
        event.preventDefault();

        var total_score = housing_type + housing_condition + dog_experience + vaccinated + pet_migration_plan + job + house_occupants;
        debugger;
        $("input[name='score']").val(total_score);
        $(this).unbind('submit').submit();
      });
    });
  </script>

  <!-- button -->
  <script>
    document.getElementById('agreementCheckbox').addEventListener('change', function() {
      document.getElementById('submitButton').disabled = !this.checked;
    });
  </script>
@endsection
