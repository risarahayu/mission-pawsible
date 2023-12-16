<div class="lang p-3 @if(Route::has('role.index')) lang-role @endif">
  <div class="tabs">
    <input type="radio" id="radio-1" name="lang" value="en" @if(session()->get('locale') == 'en' || session()->get('locale') == '') checked='' @endif>
    <label class="tab" for="radio-1">EN</label>
    <input type="radio" id="radio-2" name="lang" value="id" @if(session()->get('locale') == 'id') checked='' @endif>
    <label class="tab" for="radio-2">ID</label>
    <span class="glider"></span>
  </div>
</div>

<script type="module">
  var url = "{{ route('lang.change') }}", selectedLang = $(".lang .tabs input[type='radio']:checked").val();

  $(".lang .tabs input[type='radio']").change(function(){
    window.location.href = url + "?lang="+ $(this).val();
  });
</script>
