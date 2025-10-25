<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title }}</title>
    @livewireStyles
    <style>
        /* #loader {
            position: fixed;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            z-index: 9999;
        }
        #app {
            display: none;
        } */

        .cat{
            display: flex;
            align-items: center;
            padding-bottom: 0.8rem;
            padding-top: 0.8rem;
            border-bottom: 1px solid #ccd0d8;
            font-weight: 500;
        }
        .cat:last-child{
            border-bottom-width: 0;
        }
        @keyframes l17 {
            100% {background-size:120% 100%}
         }

    </style>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body data-theme="light">

   {{-- <div id="loader">
      <div class="animate-spin rounded-full h-16 w-16 border-b-4 border-blue-600"></div>
   </div> --}}

   <div id="app">

      {{-- Navbar --}}
      @livewire('navbar')
      
      {{-- Content --}}
      <div>
         {{ $slot }}
      </div>

   </div>

   @livewire('footer')
   @stack('scripts')
   @livewireScripts
   <script>
      // window.addEventListener('load', () => {
      //    document.getElementById('loader').style.display = 'none';
      //    document.getElementById('app').style.display = 'block';
      // });

      // FlowBite
      document.addEventListener('livewire:load', () => {
         if (window.initFlowbite) window.initFlowbite();
      });

      document.addEventListener('livewire:navigated', () => {
         // console.log('Navigated event triggered!');
         if (window.initFlowbite) {
            window.initFlowbite();
            // console.log('Flowbite re-initialized!');
         }
      });
   </script>

</body>
</html>