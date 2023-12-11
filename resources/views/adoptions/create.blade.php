@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center flex-column-reverse flex-lg-row">
    <div class="col-lg-6">
      <div class="d-flex align-items-center h-100">
        <div class="card w-100">
          <div class="card-header">{{ __('Adoptions') }}</div>
          <div class="card-body">
            @if(!$nationality_checked)
              <form action="{{ route('adoptions.create', ['dog' => $dog]) }}" method="get">
                @csrf
                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_indonesian" id="yes" value="1">
                    <label class="form-check-label" for="yes">Yes</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_indonesian" id="no" value="0">
                    <label class="form-check-label" for="no">No</label>
                  </div>
                </div>

                <button type="submit" class="btn btn-primary">Continue</button>
              </form>
            @else
              <form method="POST" action="{{ route('adoptions.store') }}" enctype="multipart/form-data">
                @csrf
                @include('adoptions.partials.form')
                <div class="mt-3">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            @endif
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-6">
      <div class="h-100 d-flex align-items-center p-5">
        <img class="img-fluid" src="{{ asset('images/new-dog.svg') }}" alt="Example Image">
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
  <!-- JavaScript Section -->
  <script type="module">
    $(function () {
      // Mendengarkan perubahan pada radio button "housing_permission"
      $('input[name="housing_permission"]').on('change', function () {
        // Cek apakah pengguna memiliki persetujuan
        if ($(this).val() == '1') {
          // Jika memiliki persetujuan, tampilkan pertanyaan berikutnya
          $('#next-question').show();
          $('#cannot-proceed').hide();
        } else {
          // Jika tidak memiliki persetujuan, tampilkan pesan "Tidak bisa lanjut"
          $('#next-question').hide();
          $('#cannot-proceed').show();

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
