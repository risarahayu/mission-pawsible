@extends('layouts.app')

@section('content')
<section>
  <div class="container">
    <div class="form-card">
      <h1 class="fw-bold text-center mb-5">{{ __('Edit Stray Dog') }}</h1>

      <div class="row justify-content-center">
        <div class="col-md-5">
          <form method="POST" action="{{ route('requests.update', $request->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('dogs.partials.form')
          </form>
        </div>
      </div>
  </div>
</section>
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

  {{-- <!-- image -->
  <script>
    $(function() {
      const imageInput = document.getElementById('images');
      const previewImage = document.getElementById('preview-image');
      const deleteButton = document.getElementById('delete-image');

      // Listen for changes in the input field
      imageInput.addEventListener('change', function () {
        const file = imageInput.files[0];

        if (file) {
          const reader = new FileReader();
          reader.onload = function (e) {
            previewImage.src = e.target.result;
            previewImage.style.display = 'block';
            deleteButton.style.display = 'block';
          };
          reader.readAsDataURL(file);
        } else {
          previewImage.src = '';
          previewImage.style.display = 'none';
          deleteButton.style.display = 'none';
        }
      });

      // Add click event listener to delete button
      deleteButton.addEventListener('click', function () {
        imageInput.value = '';
        previewImage.src = '';
        previewImage.style.display = 'none';
        deleteButton.style.display = 'none';
        $("#images").addClass("required");
      });
    });
  </script> --}}
@endsection
