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
    <!-- Setting bahasa -->
    @include('layouts.partials.lang')

    <!-- Navbar -->
    @include('layouts.partials.nav')

    <!-- Isi konten utama -->
    <main class="py-4">
      @yield('content')
    </main>

    <footer class="d-none"></footer>

    <!-- Scripts agar script selalu dibawah -->
    @yield('scripts')
  </body>
</html>
