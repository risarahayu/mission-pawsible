<script type="module">
  $(function() {
    // variable to save all required input
    const validateFields = $('#formDog .required');

    // function to check input value null or not
    function toggleInvalid(_this) {
      !!$(_this).val() ? $(_this).removeClass('is-invalid') : $(_this).addClass('is-invalid')
    }

    // using the toggleInvalid function to all required input
    validateFields.on('keyup change focusout', function() { toggleInvalid(this); });

    // fake submit function on click
    $('#fake-submit').click(function() {
      // VARIABLE DEFINITION
      const allFieldsFilled = !!validateFields.filter(function() {return !!$(this).val();}).length;
      validateFields.each(function() { toggleInvalid(this); });

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
    $('.delete-old-image').on('click', function () {
      var parents = $(this).parents('.image-preview');
      var hiddenInput = $(`#${$(this).data('deleteId')}`);
      var targetId = parents.data('previewId');

      // Sembunyikan #old-images
      parents.find('.old-images').remove();
      // Atur nilai #delete_image menjadi true
      hiddenInput.val('1');

      if (parents.find('.old-images').length == 0 && $(`#${targetId}`).val() == '') {
        parents.addClass("d-none")
        $(`#${targetId}`).addClass("required");
        $(`#${targetId}`).attr('required', true);
      } else {
        parents.removeClass("d-none")
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
        $(`#${targetId}`).attr('required', true);
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
        $(this).removeAttr('required');
        imagePreview.removeClass("d-none");
        imagePreview.addClass("border");
      } else {
        $(this).addClass("required");
        $(this).attr('required', true);
        $('#new-images').addClass('d-none');
        imagePreview.addClass("d-none");
      }
    });

    @if (false)
      // Maybe will use this later, we don't know
      $('#vaccinated, #sterilization').change(function() {
        var id_name = `${$(this).prop('id')}_certificate`;
        if ($(this).val() === 'true') {
          $(this).parent().after(`
            <div class="form-floating mb-3">
              <input id="${id_name}_certificate" type="file" name="${id_name}_certificate[]"
                      class="form-control"
                      autocomplete="${id_name}_certificate" placeholder="{{ __('Pictures') }}"
                      multiple>
              <label for="${id_name}_certificate">{{ __('Pictures') }}</label>
            </div>
          `);
        } else {
          $(this).parents('form').find(`#${id_name}_certificate`).parent().remove();
        }
      })
    @endif

  });
</script>
