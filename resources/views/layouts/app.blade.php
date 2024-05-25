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

    <footer class="py-2 text-base-color-background h-100" style="min-height: 100px">
      <div class="container base-color">
        <div class="row align-items-center">
          <div class="col-6 text-end">
            <a href="https://missionpawsible.org/"><img src="{{ asset('images/mp-logo.png') }}" alt="Mission Pawsible Logo" width="100px"></a>
          </div>
          <div class="col-6">
            <a href="https://primakara.ac.id/"><svg data-hk="0-0-0" xmlns="http://www.w3.org/2000/svg" class="bg-white p-2 rounded" width="165" height="48" viewBox="0 0 209 50" fill="none" class="header_main_wrapper_logo_img "><g clip-path="url(#a)"><path fill="#1D2B58" d="m11.802 19.69 3.435-5.88H0l1.085 3.421A3.497 3.497 0 0 0 4.41 19.69h7.391ZM41.629 13.82h-15.13l-3.434 5.875h17.846a.258.258 0 0 1 .225.381.237.237 0 0 1-.09.089l-4.3 2.582v6.84l7.892-4.745a5.782 5.782 0 0 0 2.882-5.02c0-2.95-2.209-6.002-5.891-6.002ZM12.854 37.19l-5.576 9.555c-.271.57.1.542.444.382l.775-.473 18.491-11.17v-6.843l-14.134 8.548Z"></path><path fill="#009EA9" d="M28.966 21.673V43.54a3.703 3.703 0 0 0 2.43 3.357c.845.284 3.389 1.095 3.389 1.095V21.668l-5.819.005ZM28.483 6.54a.243.243 0 0 1 .217-.125.258.258 0 0 1 .259.258v5.166h5.818V5.943c0-3.72-3.016-5.94-5.94-5.94a5.681 5.681 0 0 0-4.977 2.905L2.942 38.68a3.995 3.995 0 0 0-.212 3.615l2.087 4.76L28.483 6.539ZM78.059 47.695a2.066 2.066 0 0 1-2.066-2.066v-8.62h2.172v8.006a.775.775 0 0 0 .774.774h2.952a.775.775 0 0 0 .775-.774v-8.007h2.175v8.621a2.066 2.066 0 0 1-2.066 2.066h-4.716ZM95.32 47.695l-4.178-7.14v7.14H88.97V37.008h2.513l4.179 7.139v-7.139h2.174v10.687h-2.515ZM104.205 37.008h-2.175v10.687h2.175V37.008ZM112.043 47.695l-4.388-10.687h2.299l3.254 8.007 3.254-8.007h2.298l-4.387 10.687h-2.33ZM122.213 47.695V37.008h7.676v1.816h-5.504v2.562h5.214v1.816h-5.214v2.675h5.504v1.818h-7.676ZM140.609 47.695l-1.963-3.571h-2.544v3.571h-2.174V37.008h6.802a2.065 2.065 0 0 1 2.067 2.067v2.985a2.07 2.07 0 0 1-1.491 1.983l-.281.08 1.97 3.572h-2.386Zm-4.507-5.47h3.735a.777.777 0 0 0 .775-.774v-1.749a.776.776 0 0 0-.775-.775h-3.735v3.298ZM148.974 47.695a2.067 2.067 0 0 1-2.066-2.066v-1.157h2.172v.54a.776.776 0 0 0 .775.775h3.099a.677.677 0 0 0 .731-.68v-.73c0-.584-.969-.816-2.436-1.168-1.838-.439-4.359-1.033-4.359-2.458v-1.676a2.068 2.068 0 0 1 2.066-2.067h4.708a2.065 2.065 0 0 1 2.066 2.067v1.133h-2.174v-.516a.802.802 0 0 0-.775-.775h-2.965a.679.679 0 0 0-.733.682v.69c0 .565.96.8 2.414 1.154 1.849.45 4.391 1.067 4.391 2.464v1.733a2.068 2.068 0 0 1-2.066 2.066l-4.848-.01ZM162.163 37.008h-2.174v10.687h2.174V37.008ZM169.273 47.695v-8.87h-3.347v-1.817h8.866v1.816h-3.347v8.871h-2.172ZM182.023 47.695v-3.848l-3.734-6.839h2.105l2.717 5.096 2.714-5.096h2.107l-3.734 6.84v3.847h-2.175Z"></path><path fill="#1D2B58" d="M93.704 14.047H89.89v17.616h3.814V14.047ZM86.623 25.797V16.32a2.273 2.273 0 0 0-2.27-2.272H71.977v17.618h3.814V17.417h7.04v5.09h-5.384l5.049 9.158h4.183l-3.238-5.867h3.182ZM66.535 14.047H54.198v17.618h3.815V17.652l.026-.235h7.042v5.256h-4.984l1.86 3.357 6.859-.023v-9.703a2.275 2.275 0 0 0-2.28-2.257ZM106.813 25.743l-5.229-11.696h-3.983v17.618h3.815v-8.85l.007-1.075 4.497 9.925h1.784l4.429-9.819-.007 1.105v8.714h3.814V14.047h-3.897l-5.23 11.696ZM128.096 14.047h-2.768l-7.182 17.618h4.039l1.214-3.238h7.825l1.214 3.238h4.041l-6.732-16.51a1.775 1.775 0 0 0-1.651-1.108Zm-3.476 11.562 2.702-7.53 2.691 7.525-5.393.005ZM163.901 14.047h-2.776l-7.182 17.618h4.042l1.214-3.238h7.825l1.214 3.238h4.039l-6.733-16.51a1.769 1.769 0 0 0-1.643-1.108Zm-3.481 11.562 2.691-7.53 2.691 7.53h-5.382ZM201.925 15.155a1.77 1.77 0 0 0-1.645-1.108h-2.774l-7.169 17.618h4.039l1.216-3.238h7.823l1.214 3.238h4.042l-6.746-16.51Zm-5.132 10.454 2.697-7.53 2.691 7.525-5.388.005ZM188.751 25.797V16.32a2.276 2.276 0 0 0-2.273-2.272h-12.373v17.618h3.815V17.417h7.04v5.09h-5.385l1.862 3.358 3.177 5.787h4.184l-3.229-5.855h3.182ZM146.515 22.469l7.428-8.422h-4.907l-7.35 8.422v-8.422h-3.817v17.618h3.817v-3.719l3.585-4.065 3.571 7.743h4.326l-4.135-9.155h-2.518Z"></path></g><defs><clipPath id="a"><path fill="#fff" d="M0 0h208.658v48H0z"></path></clipPath></defs></svg></a>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-6 d-flex justify-content-center">
            <div class="d-flex p-2" style="gap: 10px">
              <i class="bi bi-instagram"></i>
              <a class="text-white" href="https://www.instagram.com/missionpawsible/">missionpawsible</a>
            </div>
            <div class="d-flex p-2" style="gap: 10px">
              <i class="bi bi-facebook"></i>
              <a class="text-white" href="https://www.instagram.com/missionpawsible/">missionpawsible</a>
            </div>
          </div>
        </div>
        <div class="row text-center">
          <p>&copy; 2024 Mission Pawsible and Primakara. All rights reserved.</p>
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
