@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center flex-column-reverse flex-lg-row">
    <div class="col-lg-6">
      <div class="d-flex align-items-center h-100">
        <div class="card w-100">
          <div class="card-header">{{ __('Stray Dog') }}</div>
  
          <div class="card-body">
            <form method="POST" action="{{ route('requests.store') }}" enctype="multipart/form-data">
              @csrf
              @include('dogs.partials.form')
            </form>
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
  <script type="module">
    $(function() {
      // FAKE SUBMIT
      $('#fake-submit').click(function() {
        // VARIABLE DEFINITION
        var validateFields = $('.required');
        var allFieldsFilled = validateFields.filter(function() {
          return $(this).val() === '';
        }).length === 0;

        validateFields.each(function() {
          if ($(this).val() === '') {
            $(this).addClass('is-invalid');
          } else {
            $(this).removeClass('is-invalid');
          }
        });

        validateFields.keyup(function() {
          if ($(this).val() === '') {
            $(this).addClass('is-invalid');
          } else {
            $(this).removeClass('is-invalid');
          };
        });
        
        if (allFieldsFilled) {
          console.log('Semua field telah diisi.');
          $('#fieldset-dog').toggleClass('d-block d-none');
          $('#fieldset-area').toggleClass('d-none d-block');
        } else {
          console.log('Ada field yang belum diisi.');
        }
      });

      // IMAGES
      // Fungsi ini akan dipanggil ketika tombol "Delete Old Image" diklik
      $('#delete-old-image').on('click', function () {
        // Sembunyikan #old-images
        $('#old-images').remove();
        // Atur nilai #delete_image menjadi true
        $('#delete_image').val('1');

        if ($('#old-images').length == 0 && $("#images").val() == '') {
          $(".image-preview").addClass("d-none")
          $("#images").addClass("required");
        } else {
          $(".image-preview").removeClass("d-none")
        }
      });

      // Fungsi ini akan dipanggil ketika tombol "Delete New Image" diklik
      $('#delete-new-image').on('click', function () {
        // Kosongkan nilai dari input file #images
        $('#images').val('');
        // Sembunyikan #new-images
        $('#new-images').addClass('d-none');

        if ($('#old-images').length == 0) {
          $(".image-preview").addClass("d-none")
          $("#images").addClass("required");
        } else {
          $(".image-preview").removeClass("d-none")
        }
      });

      $('#images').on('change', function (e) {
        // Kosongkan #new-images
        $('#new-images .images-wrapper').empty();
        
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
          $('#new-images .images-wrapper').append(img);
        });

        // Tampilkan #new-images jika ada gambar yang dipilih
        if (this.files.length > 0) {
          $('#new-images').removeClass('d-none');
          $("#images").removeClass("required");
          $(".image-preview").removeClass("d-none")
        } else {
          $('#new-images').addClass('d-none');
          $(".image-preview").addClass("d-none")
        }
      });
    });
  </script>
@endsection
