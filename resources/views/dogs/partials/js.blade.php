<script type="module">
  $(function() {
    const validateFields = $('#formDog .required');

    function toggleInvalid(_this) {
      !!$(_this).val() ? $(_this).removeClass('is-invalid') : $(_this).addClass('is-invalid')
    }

    validateFields.on('keyup change focusout', function() { toggleInvalid(this); });

    // FAKE SUBMIT
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
        $(".image-preview").removeClass("d-none");
        $(".image-preview").addClass("border");
      } else {
        $('#new-images').addClass('d-none');
        $(".image-preview").addClass("d-none");
      }
    });

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
  });
</script> 
