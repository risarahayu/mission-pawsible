<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Menggunakan CDN hanya untuk plugin yang tidak bisa dipasang melalui npm -->
    @include('layouts.partials.cdn')

    <!-- Scripts -->
    @vite(['resources/js/app.js', 'resources/sass/app.scss'])
  </head>

  <body>
    @if (!session('role'))
      <!-- Setting bahasa -->
      @include('layouts.partials.lang')
    @endif

    <!-- Navbar -->
    @include('layouts.partials.nav')

    <!-- Isi konten utama -->
    <main class="py-4">
      @yield('content')
    </main>

    <footer class="py-2 text-base-color-background">
      <div class="container base-color">
        <div class="row">
          <div class="col-2">
            <img class="img-fluid" src="{{ asset('images/mp-logo.png') }}" alt="Mission Pawsible Logo">
          </div>
          
        </div>
        <div class="row">
          <div class="col-1 text-end">
            <i class="bi bi-instagram"></i>
          </div>
          <div class="col" >
            <a class="text-white" href="https://www.instagram.com/missionpawsible/">missionpawsible</a>
          </div>
        </div>
      </div>
      
    
    </footer>

    <!-- Scripts agar script selalu dibawah -->
    @yield('scripts')

    @if(session('flash'))
      <script type="module">
        $(function() {
          toastr["{{ session('flash.type') }}"]("{{ session('flash.message') }}");
        });
      </script>
    @endif
  </body>
</html>
