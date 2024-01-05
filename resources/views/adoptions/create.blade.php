@extends('layouts.app')

@section('content')
  <section>
    <div class="container adoptions">
      @if(!$is_indonesian)
        <form action="{{ route('adoptions.create', ['dog' => $dog]) }}" method="get">
          @csrf
          <div class="form-card">
            <h1 class="fw-bold text-center mb-2">{{ __('Adoptions') }}</h1>
          </div>
          <div class="form-card">
            <label class="form-label">Are you Indonesian?</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="is_indonesian" id="yes" value="1">
              <label class="form-check-label" for="yes">Yes</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="is_indonesian" id="no" value="2">
              <label class="form-check-label" for="no">No</label>
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Continue</button>
        </form>
      @else
        <form method="POST" action="{{ route('adoptions.store') }}" enctype="multipart/form-data">
          @csrf
          <div class="form-card">
            <h1 class="fw-bold text-center mb-2">{{ __('Adoptions') }}</h1>
          </div>
          @include('adoptions.partials.form')
          <div class="mt-3">
            <button type="submit" class="btn btn-custom-submit w-100 d-none">Submit</button>
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
    });
  </script>
@endsection
